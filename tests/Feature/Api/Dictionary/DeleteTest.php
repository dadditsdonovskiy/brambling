<?php

namespace Tests\Feature\Api\Dictionary;

use App\Models\Dictionary;
use Tests\ApiTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteTest extends ApiTestCase
{
    /**
     * Check list of dictionaries with pagination
     * @return void
     */
    public function testDeleteDictionaries()
    {
        /**
         * @var $dictionary Dictionary
         */
        $dictionary = Dictionary::factory()->create(['name' => 'Spain']);
        $route = '/dictionary/'.$dictionary->id;
        $this->delete($route)->assertStatus(204);
        $this->assertDatabaseMissing('dictionaries', ['name' => 'Spain']);
    }
}
