<?php
namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\Word;
use Illuminate\Database\Seeder;

class DictionaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Word::factory(5)
            ->has(Dictionary::factory()->count(5))
            ->create();
    }
}
