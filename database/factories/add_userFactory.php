<?php

namespace Database\Factories;

use App\Models\add_user;
use Illuminate\Database\Eloquent\Factories\Factory;

class add_userFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = add_user::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'email' => $this->faker->word,
        'role' => $this->faker->word,
        'password' => $this->faker->word
        ];
    }
}
