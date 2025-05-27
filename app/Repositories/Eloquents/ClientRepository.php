<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Models\UserLanguage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Utilities\FileManager;

class ClientRepository implements ClientRepositoryInterface
{
    protected $model;

    public function __construct(User $client)
    {
        $this->model = $client;
    }
    public function index($params)
    {
        $query = $this->model
            ->whereDoesntHave('freelancer')
            ->with(['profession', 'country'])
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

        if (!empty($params['profession'])) {
            $query->whereIn('profession_id', $params['profession']);
        }

        if (!empty($params['country'])) {
            $query->whereIn('country_id', $params['country']);
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
                    'avatar' =>isset($data['avatar']) ?  FileManager::upload('users', $data['avatar']) : null,
                ]);
                if (!empty($data['languages'])) {
                    foreach ($data['languages'] as $languageId) {
                        UserLanguage::create([
                            'user_id' => $user->id,
                            'language_id' => $languageId,
                        ]);
                    }
                };
            }
        );
    }

    public function find($id)
    {
        return $this->model->with(['languages.language', 'country', 'profession'])->findOrFail($id);
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
        return $this->model->with(['languages.language', 'country', 'profession'])->findOrFail($id);
    }

    public function updateProfile($id, array $data)
    {
        $user = $this->model->findOrFail($id);

        // Update user basic info
        $user->fill([
            'username' => $data['username'] ?? $user->username,
            'gender' => $data['gender'] ?? $user->gender,
            'profession_id' => $data['profession_id'] ?? $user->profession_id,
            'country_id' => $data['country_id'] ?? $user->country_id,
        ]);

        if (isset($data['avatar'])) {
            // Handle avatar upload here
            $avatarPath = FileManager::upload('users', $data['avatar']);
            $user->avatar = $avatarPath;
        }

        $user->save();

        return $this->getUserProfile($id);
    }

    public function getArchived()
    {
        return $this->model
            ->onlyTrashed()
            ->whereDoesntHave('freelancer')
            ->with(['profession', 'country'])
            ->orderByDesc('id')
            ->get();
    }

    public function restore($id)
    {
        return $this->model->withTrashed()->findOrFail($id)->restore();
    }
}
