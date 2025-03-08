<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentUser>
 */
class StudentUserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'student_id' => Student::all()->random()->id,
            'store_id' => $this->faker->boolean(30) ? null : Store::all()->random()->id,
        ];
    }
}
