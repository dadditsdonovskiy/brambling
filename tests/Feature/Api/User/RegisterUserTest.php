<?php

namespace Tests\Feature\Api\User;

use App\Models\Auth\User;
use App\Notifications\Api\Auth\EmailVerification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\ApiTestCase;

class RegisterUserTest extends ApiTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterUserValidData()
    {
        $this->post(
            '/user/register',
            [
                'email' => 'john@example.com',
                'password' => 'password'
            ]
        )->assertStatus(200)
            ->assertJsonStructure(['result' => ['token', 'expiredAt'], 'code', 'message', 'status']);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
        $user = User::byEmail('john@example.com')->firstOrFail();
        Notification::assertSentTo($user, EmailVerification::class);
    }
}
