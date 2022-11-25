<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoginUser;
use App\Models\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(LoginUser $loginUser)
    {
        $user = User::where('email', $loginUser->get('email'))->first();

        if ($user instanceof User) {
            if (Hash::check($loginUser->get('password'), $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client');

                return response(
                    [
                        'token' => $token->accessToken,
                        'expiredAt' => Carbon::createFromTimeString($token->token['expires_at'])->unix(),
                    ],
                    201
                );
            } else {
                $response = "Password missmatch";

                return response($response, 422);
            }
        } else {
            $response = 'User does not exist';

            return response($response, 422);
        }
    }

    public function logout()
    {
        auth()->logout();

        return response("", 204);
    }
}
