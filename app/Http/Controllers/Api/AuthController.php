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
use Illuminate\Http\JsonResponse;

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
            return $this->successResponse(__('login_successful'), [
                'user' => new UserResource($result['user']),
                'token' => $result['token']
            ]);
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
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
    public function logout()
    {
        try {
            $token = auth()->user()->token();
            if ($token) {
                $token->revoke();
            }
            return $this->successResponse(__('logout_successful'));
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
}
