<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\Api\Auth\AccessTokenResource;
use App\Events\Api\Auth\User\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\RegisterUser;
use App\Services\Auth\CreateUserService;

class RegisterController extends Controller
{
    /**
     * @var CreateUserService
     */
    protected $createUserService;

    /**
     * UserController constructor.
     *
     * @param CreateUserService $createUserService
     */

    public function __construct(CreateUserService $createUserService)
    {
        $this->createUserService = $createUserService;
    }

    public function __invoke(RegisterUser $registerUser)
    {
        dd(123);
        $user = $this->createUserService->create($registerUser->only(['email','password']));
        $token = $user->createToken('Laravel Password Grant Client');

        event(new UserCreated($user));

        return new AccessTokenResource($token);
    }
}
