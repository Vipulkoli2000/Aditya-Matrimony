<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'first_name'     => $this->faker->firstName(),
            'middle_name'    => $this->faker->firstName(),
            'last_name'      => $this->faker->lastName(),
            'role'           => $this->faker->randomElement(['bride', 'groom']),
            'mother_tongue'  => $this->faker->randomElement(['Hindi', 'English', 'Tamil', 'Telugu', 'Marathi']),
            'native_place'   => $this->faker->city(),
            'gender'         => $this->faker->randomElement(['male', 'female']),
            'marital_status' => $this->faker->randomElement(['Single', 'Married']),
            'living_with'    => $this->faker->randomElement(['Parents', 'Alone', 'WithSpouse', 'Guardian']),
            'email'          => $this->faker->unique()->safeEmail(),
            'mobile'         => $this->faker->unique()->numerify('##########'),
        ];
    }
}
