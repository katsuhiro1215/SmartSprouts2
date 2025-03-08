<?php

namespace Database\Factories;

use App\Models\Guardian;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuardianFactory extends Factory
{

    protected $model = Guardian::class;

    public function definition(): array
    {
        return [
            'lastname' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'lastname_kana' => $this->faker->lastKanaName(),
            'firstname_kana' => $this->faker->firstKanaName(),
            'relationship' => $this->faker->randomElement(['父親', '母親', '兄弟', '親戚', '友達']),
            'guardian_photo_path' => $this->faker->imageUrl(),
            'birth' => fake()->dateTimeBetween('1960-01-01', '2000-12-31'),
            'gender' => $this->faker->randomElement(['男性', '女性']),
            'mobile_phone_number' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'company_phone_number' => $this->faker->phoneNumber(),
            'is_temporary' => $this->faker->boolean(30),
        ];
    }
}
