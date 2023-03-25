<?php

namespace Database\Factories;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Participant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'uuid' => $this->faker->word,
        'pref' => $this->faker->word,
        'district' => $this->faker->word,
        'dan' => $this->faker->word,
        'dan_number' => $this->faker->word,
        'role' => $this->faker->word,
        'email' => $this->faker->word,
        'phone' => $this->faker->word,
        'seat_number' => $this->faker->word
        ];
    }
}
