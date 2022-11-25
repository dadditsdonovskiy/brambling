<?php

namespace Tests\Feature\Api\User;

use Tests\ApiTestCase;

class CurrentTest extends ApiTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginAndGetCurrentUser()
    {
        $this->loginUser();
        $this->get('/user/current')->assertStatus(200);

    }
    public function testNotLoginAndGetCurrentUser()
    {
        $this->get('/user/current')->assertStatus(401);
    }
}
