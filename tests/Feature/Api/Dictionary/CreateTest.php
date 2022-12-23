<?php

namespace Tests\Feature\Api\Dictionary;

use App\Models\Dictionary;
use App\Validators\ErrorList;
use Database\Factories\DictionaryFactory;
use Illuminate\Support\Str;
use Tests\ApiTestCase;

class CreateTest extends ApiTestCase
{
    /**
     * Check dictionary record successfully created and check response structure
     * @return void
     */
    public function testSuccessCreate()
    {
        $route = '/dictionary';
        $requestData = ['name' => 'French'];
        $this->post($route, $requestData)->assertStatus(201)
            ->assertJsonStructure(['result' => ['name'], 'code', 'message', 'status']);
        $this->assertDatabaseHas('dictionaries', ['name' => 'French']);
    }

    /**
     * Check dictionary name is not more than 50 characters
     * @return void
     */
    public function testValidateNameLength()
    {
        $stingOver50 = Str::random(51);
        $route = '/dictionary';
        $requestData = ['name' => $stingOver50];
        $this->post(
            $route,
            $requestData
        )
            ->assertJsonFragment(
                [
                    'result' => [
                        [
                            'code' => ErrorList::STRING_TOO_LONG,
                            'field' => 'name',
                            'message' => "Name should contain at most 50 character(s)."
                        ]
                    ]
                ]
            );
    }

    /**
     * Check dictionary name is not more than 50 characters
     * @return void
     */
    public function testValidateNameCanNotBeBlanc()
    {
        $stingOver50 = '';
        $route = '/dictionary';
        $requestData = ['name' => $stingOver50];
        $this->post(
            $route,
            $requestData
        )
            ->assertJsonFragment(
                [
                    'result' => [
                        [
                            'code' => ErrorList::REQUIRED_VALUE,
                            'field' => 'name',
                            'message' => "Name cannot be blank."
                        ]
                    ]
                ]
            );
    }

    /**
     * Check dictionary name is not more than 50 characters
     * @return void
     */
    public function testValidateNameUnique()
    {
        Dictionary::factory()->create(['name' => 'French']);
        $route = '/dictionary';
        $requestData = ['name' => 'French'];
        $this->post(
            $route,
            $requestData
        )
            ->assertJsonFragment(
                [
                    'result' => [
                        [
                            'code' => ErrorList::UNIQUE_INVALID,
                            'field' => 'name',
                            'message' => "Name has already been taken."
                        ]
                    ]
                ]
            );
    }
}
