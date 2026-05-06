<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use App\Auth\Requests\LoginRequest;
use App\Auth\Resources\UserResource;
use App\Auth\Services\AuthJwtService;
use App\Core\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Hash;

readonly class LoginAction
{
    public function __construct(
        private AuthJwtService $service
    ) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function execute(LoginRequest $request): UserResource
    {
        $user = User::query()->where('email', $request->get('email'))->first();

        if (!$user) {
            throw new InvalidCredentialsException();
        }

        if (!Hash::check($request->password, $user->password)) {
            throw new InvalidCredentialsException();
        }

        $token = $this->service->generateToken($user);

        return new UserResource($user, $token);
    }
}
