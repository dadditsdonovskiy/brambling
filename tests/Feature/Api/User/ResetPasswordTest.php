<?php

namespace Tests\Feature\Api\User;

use App\Models\Auth\User;
use App\Notifications\Api\Auth\RecoveryPassword;
use Illuminate\Support\Facades\Notification;
use Tests\ApiTestCase;

class ResetPasswordTest extends ApiTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSendEmail()
    {
        $user = User::factory()->create(['email' => 'john@example.com']);
        $this->post('/user/recovery-password', ['email' => 'john@example.com'])->assertStatus(204);
        Notification::assertSentTo($user, RecoveryPassword::class);
    }

    /** @test */
    public function testNotConfirmPassword()
    {
        $user = User::factory()->create(['email' => 'john@example.com']);
        $token = $this->app->make('auth.password.broker')->createToken($user);
        $this->post(
            '/user/new-password',
            [
                'resetToken' => $token,
                'password' => '12345678',
                'confirmPassword' => '123456781',
                'email' => $user->email,

            ]
        )->assertStatus(422);
    }

    /** @test */
    public function testNotExistEmail()
    {
        $user = User::factory()->create(['email' => 'john@example.com']);
        $token = $this->app->make('auth.password.broker')->createToken($user);
        $this->post(
            '/user/new-password',
            [
                'resetToken' => $token,
                'password' => '12345678',
                'confirmPassword' => '12345678',
                'email' => 'john2@example.com',

            ]
        )->assertStatus(422);
    }

    /** @test */
    public function testLoginAfterChange()
    {
        $user = User::factory()->create(['email' => 'john@example.com']);
        $this->post('/user/login', ['email' => 'john@example.com', 'password' => '12345678'])->assertStatus(422);

        $token = $this->app->make('auth.password.broker')->createToken($user);

        $this->post(
            '/user/new-password',
            [
                'resetToken' => $token,
                'password' => '12345678',
                'confirmPassword' => '12345678',
                'email' => $user->email,
            ]
        )->assertStatus(204);

        $this->post('/user/login', ['email' => $user->email, 'password' => '12345678'])->assertStatus(201);

    }
}
