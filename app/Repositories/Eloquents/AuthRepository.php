<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Models\UserLanguage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Carbon\Carbon;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * Register a new user
     *
     * @param array $data
     * @return User
     */
    public function register(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'prefix' => $data['prefix'] ?? null,
                'phone' => $data['phone'] ?? null,
                'gender' => $data['gender'] ?? null,
                'profession_id' => $data['profession_id'] ?? null,
                'country_id' => $data['country_id'] ?? null,
                'password' => Hash::make($data['password']),
                'avatar' => $data['avatar'] ?? null,
            ]);
            if (!empty($data['languages'])) {
                foreach ($data['languages'] as $languageId) {
                    UserLanguage::create([
                        'user_id' => $user->id,
                        'language_id' => $languageId,
                    ]);
                }
            }
            return $user->load(['profession', 'country', 'languages.language']);
        });
    }
    /**
     * Authenticate user credentials
     *
     * @param array $data
     * @return User|null
     */
    public function login(array $data)
    {
        $user = User::with(['profession', 'country','languages.language'])
            ->where('prefix', $data['prefix'])
            ->where('phone', $data['phone'])
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        return $user;
    }

    public function findByPhoneAndPrefix($phone,$prefix)
    {
        return User::where('phone', $phone)
            ->where('prefix', $prefix)
            ->first();
    }

    public function updateCode($user,$code): User
    {
        $user->update(['code' => $code]);
        return $user->fresh();
    }

    public function clearCode($user): User
    {
        $user->update([
            'code' => null,
            'verified_at'=>Carbon::now()
        ]);
        return $user->load(['profession', 'country', 'languages.language']);
    }
    public function updatePassword($user,$password): User
    {
        $user->update([
            'password' => Hash::make($password)
        ]);
        return $user->load(['profession', 'country', 'languages.language']);
    }
}
