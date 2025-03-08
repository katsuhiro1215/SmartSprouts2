<?php

namespace Database\Factories;

use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questionnary>
 */
class QuestionnaryFactory extends Factory
{
    protected $model = Questionnaire::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement(['draft', 'review', 'published', 'paused', 'archived']),
            'publish_at' => $this->faker->dateTime(),
            'unpublish_at' => $this->faker->dateTime(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
