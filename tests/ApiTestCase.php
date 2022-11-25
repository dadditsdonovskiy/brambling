<?php

namespace Tests;

use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase.
 */
abstract class ApiTestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    /**
     * Create an administrator.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    protected function createUser(array $attributes = [])
    {
        return User::factory()->create($attributes);
    }

    /**
     * Login the given administrator or create the first if none supplied.
     *
     * @param bool $user
     *
     * @return bool|mixed
     */
    protected function loginUser($user = false)
    {
        if (!$user) {
            $user = User::factory()->create();
        }
        Passport::actingAs($user);
        return $user;
    }
    public function prepareUrlForRequest($uri)
    {
        return parent::prepareUrlForRequest(config('api.prefix').$uri);
    }
    public function addUserAndLogin($email,$password){
       $user = $this->createUser([
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make($password), // password
            'remember_token' => Str::random(10),
        ]);
        return $this->loginUser($user);
    }
    public function setUp():void {
        parent::setUp();
        Notification::fake();
        $this->artisan('passport:install');
    }

}
