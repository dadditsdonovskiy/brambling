<?php

namespace Tests\Feature\Api\User;

use App\Validators\ErrorList;
use Tests\ApiTestCase;

class AuthTest extends ApiTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        // Try create user
        $this->post(
            '/user/register',
            [
                'email' => 'john@example.com',
                'password' => 'password',
            ]
        )
            ->assertJsonStructure(['result' => ['token', 'expiredAt'], 'code', 'message', 'status'])
            ->assertStatus(200);

        // Try login  credential
        $this->post(
            '/user/login',
            [
                'email' => 'john@example.com',
                'password' => 'password',
            ]
        )->assertStatus(201)
            ->assertJsonStructure(['result' => ['token', 'expiredAt'], 'code', 'message', 'status']);
        // Try login not valid credential
        $this->post(
            '/user/login',
            [
                'email' => 'john@example.com',
                'password' => 'password1',
            ]
        )->assertStatus(422);
    }

    public function testLoginWithOutEmail()
    {
        $this->post(
            '/user/login',
            [
                'password' => 'password1',
            ]
        )
            ->assertJsonFragment(
                [
                    'result' => [
                        [
                            'code' => ErrorList::REQUIRED_VALUE,
                            'field' => 'email',
                            'message' => "Email cannot be blank."
                        ]
                    ]
                ]
            )
            ->assertStatus(422);
    }

    public function testLoginWithOutPassword()
    {
        $this->post(
            '/user/login',
            [
                'email' => 'john@example.com',
            ]
        )
            ->assertJsonFragment(
                [
                    'result' => [
                        [
                            'code' => ErrorList::REQUIRED_VALUE,
                            'field' => 'password',
                            'message' => "Password cannot be blank."
                        ]
                    ]
                ]
            )
            ->assertStatus(422);
    }

    public function testLoginUserNotExist()
    {
        $this->post(
            '/user/login',
            [
                'email' => 'john@example.com',
                'password' => 'password1',
            ]
        )->assertStatus(422);
    }

    public function testLoginUserWrongEmail()
    {
        $this->post(
            '/user/login',
            [
                'email' => 'johnample.com',
                'password' => 'password1',
            ]
        )->assertStatus(422)
            ->assertJsonPath('result.0.code', ErrorList::EMAIL_INVALID);
    }

    public function testLoginUserWrongRequiredPassword()
    {
        $this->post(
            '/user/login',
            [
                'email' => 'john@example.com',
            ]
        )->assertStatus(422)
            ->assertJsonPath('result.0.code', ErrorList::REQUIRED_VALUE);
    }

}
