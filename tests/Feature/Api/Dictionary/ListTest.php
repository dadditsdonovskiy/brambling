<?php

namespace Tests\Feature\Api\Dictionary;

use App\Models\Dictionary;
use Tests\ApiTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListTest extends ApiTestCase
{
    /**
     * Check list of dictionaries with pagination
     * @return void
     */
    public function testListDictionaries()
    {
        $route = '/dictionary';
        $this->get($route)->assertStatus(200)
        ->assertJsonPath('_meta.pagination.currentPage', 1)
         ->assertJsonPath('_meta.pagination.pageCount', 1)
         ->assertJsonPath('_meta.pagination.perPage', 10);
    }
}
