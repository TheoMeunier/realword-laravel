<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use App\Auth\Requests\RegisterRequest;
use App\Auth\Resources\UserResource;
use App\Auth\Services\AuthJwtService;
use Illuminate\Support\Facades\Hash;

readonly class RegisterAction
{
    public function __construct(
        private AuthJwtService $service,
    ) {}

    public function execute(RegisterRequest $request): UserResource
    {
        $user = User::query()->create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $this->service->generateToken($user);

        return new UserResource($user, $token);
    }
}
