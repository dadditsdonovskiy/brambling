<?php

namespace Tests\Feature\Api\User;

use Tests\ApiTestCase;

class ChangePasswordTest extends ApiTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginUserChangePassword()
    {
        $this->addUserAndLogin( 'john@example.com','password');

        // Try change password
        $this->patch('/user/change-password',['password'=>'new_password'])->assertStatus(204);


        $this->post('/user/login',[
            'email' => 'john@example.com',
            'password' => 'password'
        ])->assertStatus(422);

        // Try login new credential
        $this->post('/user/login',[
            'email' => 'john@example.com',
            'password' => 'new_password'
        ])->assertStatus(201);

    }
}
