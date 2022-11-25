<?php
/**
 * Copyright © 2020 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Tests\Feature\Api\User;

use App\Models\Auth\User;
use App\Models\Auth\UserToken;
use App\Notifications\Api\Auth\EmailVerification;
use App\Validators\ErrorList;
use Illuminate\Support\Facades\Notification;
use Tests\ApiTestCase;

class EmailVerificationTest extends ApiTestCase
{
    public function testNotFoundVerifiedUser()
    {
        $user = User::factory()->create(['email_verified_at' => time()]);
        $this->post('/email/resend', ['email' => $user->email])
            ->assertNotFound();
    }

    public function testDeactivateOldTokenAfterResend()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        $token = UserToken::factory()->create(
            ['user_id' => $user->id, 'action' => UserToken::ACTION_EMAIL_VERIFICATION]
        );
        $this->post('/email/resend', ['email' => $user->email])
            ->assertNoContent();
        $this->assertDatabaseMissing('user_tokens', ['token' => $token->token]);
    }

    public function testWrongEmailUser()
    {
        $this->post('/email/resend', ['email' => 'testemail'])
            ->assertStatus(422)
            ->assertJsonFragment(
                [
                    'result' => [
                        [
                            'code' => ErrorList::EMAIL_INVALID,
                            'field' => 'email',
                            'message' => 'Email is not a valid email address.',
                        ]
                    ]
                ]
            );
    }

    public function testSuccessResend()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        $this->post('/email/resend', ['email' => $user->email])
            ->assertNoContent();
        Notification::assertSentTo($user, EmailVerification::class);
    }

    public function testSuccessVerified()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        $token = UserToken::factory()->create(
            ['user_id' => $user->id, 'action' => UserToken::ACTION_EMAIL_VERIFICATION]
        );
        $this->loginUser($user);
        $this->get('/user/current')->assertForbidden();
        $this->post('/email/verification', ['token' => $token->token])->assertNoContent();
        $this->assertDatabaseMissing('user_tokens', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('users', ['id' => $user->id, 'email_verified_at' => null]);
        $user->refresh();
        $this->loginUser($user);
        $this->get('/user/current')->assertOk();
    }

    public function testExpireTokenVerifiedNotFound()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        $token = UserToken::factory()->create(
            [
                'user_id' => $user->id,
                'action' => UserToken::ACTION_EMAIL_VERIFICATION,
                'expires_at' => time() - 1,
            ]
        );

        $this->post('/email/verification', ['token' => $token->token])->assertNotFound();
    }
}
