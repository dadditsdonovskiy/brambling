<?php

namespace Database\Factories;

use App\Models\Dictionary;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Word::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dictionary_id'=>Dictionary::factory(1)->create()->first(),
            'name' => $this->faker->unique()->text(10),
        ];
    }
}
