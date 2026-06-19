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

        throw_unless($user, InvalidCredentialsException::class);

        throw_unless(Hash::check($request->password, $user->password), InvalidCredentialsException::class);

        $token = $this->service->generateToken($user);

        return new UserResource($user, $token);
    }
}
