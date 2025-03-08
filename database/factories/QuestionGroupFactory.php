<?php

namespace Database\Factories;

use App\Models\QuestionGroup;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionGroup>
 */
class QuestionGroupFactory extends Factory
{
    protected $model = QuestionGroup::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'questionnaire_id' => Questionnaire::all()->random()->id,
            'group_name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'parent_group_id' => null,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
