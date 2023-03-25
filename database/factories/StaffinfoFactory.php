<?php

namespace Database\Factories;

use App\Models\Staffinfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffinfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staffinfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'furigana' => $this->faker->word,
            'gender' => $this->faker->word,
            'bs_id' => $this->faker->word,
            'prefecture' => $this->faker->word,
            'district' => $this->faker->word,
            'dan' => $this->faker->word,
            'role' => $this->faker->word,
            'cell_phone' => $this->faker->word,
            'zip' => $this->faker->word,
            'address' => $this->faker->word,
            'team' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
