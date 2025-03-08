<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentEnrollmentFactory extends Factory
{
    protected $model = StudentEnrollment::class;

    public function definition(): array
    {
        return [
            'student_id' => Student::all()->random()->id,
            'application_date' => $this->faker->dateTimeBetween('2023-05-01', '2024-12-31'),
            'enrollment_date' => $this->faker->dateTimeBetween('2023-05-01', '2024-12-31'),
            'selected_days' => $this->faker->randomElement(['月曜日', '火曜日', '木曜日', '金曜日', '土曜日', '日曜日']),
            'preferred_days' => $this->faker->randomElement(['月曜日', '火曜日', '木曜日', '金曜日', '土曜日', '日曜日']),
            'status' => $this->faker->randomElement(['承認済み', '承認待ち', 'キャンセル']),
            'is_paid' => $this->faker->boolean(),
            'is_notified' => $this->faker->boolean(),
            'cancel_date' => null,
            'suspension_start_date' => null,
            'suspension_end_date' => null,
            'suspension_reason' => null,
            'withdrawal_date' => null,
            'withdrawal_reason' => null,
            'remarks' => $this->faker->text(),
        ];
    }
}
