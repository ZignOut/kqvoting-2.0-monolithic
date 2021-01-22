<?php

namespace Database\Factories;

use App\Models\Nominee;
use Illuminate\Database\Eloquent\Factories\Factory;

class NomineeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nominee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'class' => '1CST-A',
            'age' => $this->faker->numberBetween(16, 20),
            'hobby' => $this->faker->sentence,
            'description' => $this->faker->sentence
        ];
    }
}
