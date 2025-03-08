<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{

    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'lastname' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'lastname_kana' => $this->faker->lastKanaName(),
            'firstname_kana' => $this->faker->firstKanaName(),
            'student_photo_path' => $this->faker->imageUrl(),
            'birth' => fake()->dateTimeBetween('2000-01-01', '2020-12-31'),
            'gender' => $this->faker->randomElement(['男性', '女性']),
            'blood' => $this->faker->randomElement(['A', 'B', 'O', 'AB']),
            'mobile_number' => $this->faker->phoneNumber(),
            'mobile_number_relationship' => $this->faker->randomElement(['父親', '母親', '兄弟', '親戚', '友達']),
            'personal_history' => $this->faker->text(),
            'member_no' => $this->faker->randomNumber(),
            'membership_status' => $this->faker->randomElement(['会員', '非会員']),
            'is_temporary' => $this->faker->boolean(30),
            'serial_no' => $this->faker->randomNumber(),
            'permission_photo' => $this->faker->boolean(),
            'permission_dm' => $this->faker->boolean(),
            'remarks' => $this->faker->text(),
        ];
    }
}
