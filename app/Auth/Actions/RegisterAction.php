<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use App\Auth\Requests\RegisterRequest;
use App\Auth\Resources\ProfileResource;
use App\Auth\Services\AuthJwtService;
use Illuminate\Support\Facades\Hash;

readonly class RegisterAction
{
    public function __construct(
        private AuthJwtService $service,
    ) {}

    public function execute(RegisterRequest $request): ProfileResource
    {
        $user = User::query()->create([
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $this->service->generateToken($user);

        return new ProfileResource($user, $token);
    }
}
