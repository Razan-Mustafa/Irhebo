<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GenerateCodeRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\VerifyCodeRequest;
use App\Http\Resources\UserResource;
use App\Models\Notification;
use App\Models\PlayerId;
use App\Models\User;
use App\Services\OneSignalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $result = $this->authService->register($request->validated());
            return $this->successResponse(__('success'), 201);
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    /**
     * Login user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $result = $this->authService->login($request->validated());
            // dd($result);
            $user = $result['user'];

            if ($request->input('player_id')) {
                // Check if this player_id already exists for this user
                $exists = PlayerId::where('user_id', $user->id)
                    ->where('player_id', $request->player_id)
                    ->where('platform', $request->platform)
                    ->exists();

                if (!$exists) {
                    PlayerId::create([
                        'user_id'   => $user->id,
                        'player_id' => $request->player_id,
                        'platform'  => $request->platform,
                    ]);
                }
            }

            return $this->successResponse(__('login_successful'), [
                'user' => new UserResource($result['user']),
                'token' => $result['token']
            ]);
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'google_id' => 'required|string',
            'email' => 'required|string',
            'player_id' => 'nullable|string',
            'platform'  => 'nullable|string',
        ]);

        try {
            $user = User::with(['languages.language'])->where('email', $request->email)->first();
            if ($user) {
                if ($user->google_id == null || $user->google_id == $request->google_id) {
                    $user->google_id = $request->google_id;
                    $user->save();

                    if ($request->input('player_id')) {
                        $exists = PlayerId::where('user_id', $user->id)
                            ->where('player_id', $request->player_id)
                            ->where('platform', $request->platform)
                            ->exists();

                        if (!$exists) {
                            PlayerId::create([
                                'user_id'   => $user->id,
                                'player_id' => $request->player_id,
                                'platform'  => $request->platform,
                            ]);
                        }
                    }
                    $token = $user->createToken('User Token')->accessToken;

                    return $this->successResponse(__('login_successful'), [
                        'user'  => new UserResource($user),
                        'token' => $token
                    ]);
                } else {
                    return $this->successResponse(__('user_not_found'));
                };
            } else {
                return $this->successResponse(__('user_not_found'));
            }
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function SendNotification($userId)
    {
        // one signal notification
        $user = User::where('id', $userId)->first();
        if ($user) {
            $playerIdRecord = PlayerId::where('user_id', $user->id)
                ->where('is_notifiable', 1)
                ->pluck('player_id')->toArray();


            if ($playerIdRecord) {
                $titles = [
                    'en' => __('notifications.item_added_title', [], 'en'),
                    'ar' => __('notifications.item_added_title', [], 'ar'),
                ];

                $messages = [
                    'en' => __('notifications.item_added_message', [], 'en'),
                    'ar' => __('notifications.item_added_message', [], 'ar'),
                ];

                $response = app(OneSignalService::class)->sendNotificationToUserCall(
                    $playerIdRecord, // نرسل player_id من جدول player_ids
                    $titles,
                    $messages,
                    'call',
                    1
                );

                Notification::create([
                    'user_id'           => $user->id,
                    'title'             => json_encode($titles),
                    'body'              => json_encode($messages),
                    'type'              => 'call',
                    'type_id'           => 1,
                    'is_read'           => false,
                    'onesignal_id'      => $response['id'] ?? null,
                    'response_onesignal' => json_encode($response),
                ]);
            }
        }
        // *********************************************//

        return $this->successResponse('sent');
    }


    public function generateCode(GenerateCodeRequest $request)
    {
        try {
            $result = $this->authService->findByPhoneAndPrefix($request->validated());
            if (!$result['user']) {
                return $this->errorResponse(__('user_not_found'), 404);
            }

            $result = $this->authService->generateCode($result['user']);
            return $this->successResponse(__('code_generated_successfully'));
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    /**
     * Verify code
     *
     * @param VerifyCodeRequest $request
     * @return JsonResponse
     */


    public function verifyCode(VerifyCodeRequest $request)
    {
        try {
            $result = $this->authService->findByPhoneAndPrefix($request->validated());
            if (!$result['user']) {
                return $this->errorResponse(__('user_not_found'), 404);
            }

            if ($result['user']->code !== $request['code']) {
                return $this->errorResponse(__('invalid_verification_code'));
            }
            $result = $this->authService->verifyCode($result['user']);
            return $this->successResponse(__('code_verified_successfully'), [
                'user' => new UserResource($result['user']),
                'token' => $result['token']
            ]);
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    /**
     * Reset password
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */


    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $result = $this->authService->findByPhoneAndPrefix($request->validated());
            if (!$result['user']) {
                return $this->errorResponse(__('user_not_found'), 404);
            }

            $result = $this->authService->resetPassword($result['user'], $request->password);
            return $this->successResponse(__('password_reset_successfully'), [
                'user' => new UserResource($result['user']),
                'token' => $result['token']
            ]);
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }


    // public function logout()
    // {
    //     try {
    //         $token = auth()->user()->token();
    //         if ($token) {
    //             $token->revoke();
    //         }
    //         return $this->successResponse(__('logout_successful'));
    //     } catch (Exception $e) {
    //         return $this->exceptionResponse($e);
    //     }
    // }

    public function logout(Request $request)
    {
        try {
            $user = auth()->user();

            // Revoke the current token (if using Passport)
            $token = $user->token();
            if ($token) {
                $token->revoke();
            }

            // Delete player_id for this device if provided
            if ($request->filled('player_id')) {
                PlayerId::where('user_id', $user->id)
                    ->where('player_id', $request->player_id)
                    ->delete();
            }

            return $this->successResponse(__('logout_successful'));
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
}
