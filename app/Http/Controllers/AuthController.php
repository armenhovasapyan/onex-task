<?php

namespace App\Http\Controllers;

use App\Enums\SystemRoles;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {}

    /**
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function register(RegisterRequest $request): UserResource
    {
        $data = $request->validated();
        $data['role'] = SystemRoles::USER->value;
        $data['password'] = Hash::make($request->password);
        $user = $this->userService->createUser($data);

        return new UserResource($user);
    }

    /**
     * @param LoginRequest $request
     * @return array
     */
    public function login(LoginRequest $request): array
    {
        $user = $this->userService->getUserByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $this->userService->createUserToken($user);

        return [
            'token' => $token,
            'user' => new UserResource($user),
        ];
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
