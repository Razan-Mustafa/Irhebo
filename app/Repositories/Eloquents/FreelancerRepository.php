<?php

namespace App\Repositories\Eloquents;

use App\Enums\FreelancerStatusEnum;
use App\Models\User;
use App\Models\Freelancer;
use App\Models\FreelancerCateogry;
use App\Models\UserLanguage;
use App\Utilities\FileManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\FreelancerRepositoryInterface;

class FreelancerRepository implements FreelancerRepositoryInterface
{
    protected $model;
    protected $freelancer;
    protected $UserLanguage;
    public function __construct(User $user, Freelancer $freelancer, UserLanguage $UserLanguage)
    {
        $this->model = $user;
        $this->freelancer = $freelancer;
        $this->UserLanguage = $UserLanguage;
    }
    public function index($params)
    {
        $query = $this->model
            ->whereHas('freelancer')
            ->with(['freelancer', 'profession', 'country'])
            ->orderByDesc('id');
        if (!empty($params['username'])) {
            $query->where('username', 'like', '%' . $params['username'] . '%');
        }
        if (!empty($params['email'])) {
            $query->where('email', 'like', '%' . $params['email'] . '%');
        }
        if (!empty($params['phone'])) {
            $query->where('phone', 'like', '%' . $params['phone'] . '%');
        }
        if (!empty($params['gender'])) {
            $query->where('gender', $params['gender']);
        }
        if (!empty($params['profession_id'])) {
            $query->where('profession_id', $params['profession_id']);
        }
        if (!empty($params['country_id'])) {
            $query->where('country_id', $params['country_id']);
        }
        return $query->get();
    }
    public function store($data)
    {
        return DB::transaction(
            function () use ($data) {
                $user = User::create([
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'prefix' => $data['prefix'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'gender' => $data['gender'] ?? null,
                    'profession_id' => $data['profession_id'] ?? null,
                    'country_id' => $data['country_id'] ?? null,
                    'password' => Hash::make($data['password']),
                    'avatar' => isset($data['avatar']) ? FileManager::upload('users', $data['avatar']) : null,
                    'verified_at'=>Auth::guard('admin')->check() ? now() : ''
                ]);
                Freelancer::create([
                    'user_id' => $user->id,
                    'status' => Auth::guard('admin')->check() ? FreelancerStatusEnum::VERIFIED->value : FreelancerStatusEnum::UNVERIFIED->value,
                    'bio' => $data['bio'] ?? null,
                ]);
                if (!empty($data['languages'])) {
                    foreach ($data['languages'] as $languageId) {
                        UserLanguage::create([
                            'user_id' => $user->id,
                            'language_id' => $languageId,
                        ]);
                    }
                };

                if (!empty($data['category_ids'])) {
                    foreach ($data['category_ids'] as $categoryId) {
                        FreelancerCateogry::create([
                            'user_id' => $user->id,
                            'category_id' => $categoryId,
                        ]);
                    }
                }
                if (!empty($data['file']) && is_array($data['file'])) {
                    foreach ($data['file'] as $index => $file) {
                        $filePath = FileManager::upload('freelancers', $file);
                        $fileName = pathinfo(strip_tags($file->getClientOriginalName()), PATHINFO_FILENAME);
                        $description = $data['description'][$index] ?? null;
                        $user->certificates()->create([
                            'file_name' => trim($fileName),
                            'file_path' => $filePath,
                            'description' => $description,
                        ]);
                    }
                }
            }
        );
    }
    public function find($id)
    {
        return $this->model
            ->with([
                'languages.language',
                'profession',
                'country'
            ])
            ->findOrFail($id);
    }
    public function delete($id)
    {
        $client = $this->find($id);
        return $client->delete();
    }
    public function updateActivation($id)
    {
        $client = $this->find($id);
        $client->is_active = !$client->is_active;
        $client->save();
        return $client;
    }
    public function getUserProfile($id)
    {
        return $this->model->with('freelancer', 'languages.language', 'profession', 'country', 'certificates')->find($id);
    }
    public function completeProfile(array $data)
    {
        $userId = Auth::id();
        $user = $this->model->findOrFail($userId);
        if (!empty($data['avatar'])) {
            $user->update([
                'avatar' => FileManager::upload('users', $data['avatar']),
            ]);
        }
        if (!$user->freelancer) {
            $user->freelancer()->create([
                'bio' => $data['bio'] ?? '',
                'status' => 'pending',
            ]);
        }
        if (!empty($data['category_ids'])) {
            foreach ($data['category_ids'] as $categoryId) {
                FreelancerCateogry::create([
                    'user_id' => $userId,
                    'category_id' => $categoryId,
                ]);
            }
        }
        if (!empty($data['file']) && is_array($data['file'])) {
            foreach ($data['file'] as $index => $file) {
                $filePath = FileManager::upload('freelancers', $file);
                $fileName = pathinfo(strip_tags($file->getClientOriginalName()), PATHINFO_FILENAME);
                $description = $data['description'][$index] ?? null;
                $user->certificates()->create([
                    'file_name' => trim($fileName),
                    'file_path' => $filePath,
                    'description' => $description,
                ]);
            }
        }
        return $this->getUserProfile($userId);
    }
    public function updateProfile($id, array $data)
    {
        $user = $this->model->findOrFail($id);
        $user->fill([
            'username' => $data['username'] ?? $user->username,
            'gender' => $data['gender'] ?? $user->gender,
            'profession_id' => $data['profession_id'] ?? $user->profession_id,
            'country_id' => $data['country_id'] ?? $user->country_id,
        ]);
        if (isset($data['avatar'])) {
            $avatarPath = isset($data['avatar']) ? FileManager::upload('users', $data['avatar']) : null;
            $user->avatar = $avatarPath;
        }
        $user->save();
        if ($user->freelancer) {
            $user->freelancer->update([
                'nick_name' => $data['nick_name'] ?? $user->freelancer->nick_name,
                'description' => $data['description'] ?? $user->freelancer->description,
            ]);
            if (!empty($data['languages'])) {
                $user->freelancer->languages()->delete();
                foreach ($data['languages'] as $language) {
                    $this->UserLanguage->create([
                        'freelancer_id' => $user->freelancer->id,
                        'language_id' => $language['language_id'],
                        'level' => $language['level']
                    ]);
                }
            }
        }
        return $this->getUserProfile($id);
    }
    public function getArchived()
    {
        return $this->model
            ->onlyTrashed()
            ->whereHas('freelancer')
            ->with(['freelancer', 'profession', 'country'])
            ->orderByDesc('id')
            ->get();
    }
    public function restore($id)
    {
        return $this->model->withTrashed()->findOrFail($id)->restore();
    }
}
