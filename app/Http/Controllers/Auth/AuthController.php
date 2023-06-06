<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\User\Actions\CreateUserAction;
use App\Services\User\Actions\LoginAction;
use App\Services\User\Actions\LogoutAction;
use App\Services\User\Actions\RefreshTokenAction;
use App\Services\User\Dto\CreateUserDto;
use App\Services\User\Dto\RefreshTokenDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private CreateUserAction $createUserAction;
    private LoginAction $loginAction;
    private LogoutAction $logoutAction;
    private RefreshTokenAction $refreshTokenAction;

    public function __construct(
        CreateUserAction $createUserAction,
        LoginAction $loginAction,
        LogoutAction $logoutAction,
        RefreshTokenAction $refreshTokenAction,
    )
    {
        $this->createUserAction = $createUserAction;
        $this->loginAction = $loginAction;
        $this->logoutAction = $logoutAction;
        $this->refreshTokenAction = $refreshTokenAction;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $username = $request->getUserName();
        $password = $request->getPassword();
        $result = $this->loginAction->run($username, $password);

        return $this->response(['data' => $result->toArray($request)]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = CreateUserDto::fromRequest($request);
        $this->createUserAction->run($dto);

        return $this->response( ['Signed up.'], 201);
    }

    public function logout(): JsonResponse
    {
        $user = Auth::user();
        $this->logoutAction->run($user);

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refreshToken(RefreshTokenRequest $request): JsonResponse
    {
        $dto = RefreshTokenDto::fromRequest($request);
        $result = $this->refreshTokenAction->run($dto);

        return $this->response(['data' => $result->toArray($request)]);
    }
}
