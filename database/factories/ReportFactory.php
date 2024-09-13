<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $dated = $this->faker->dateTimeBetween('-2 months');
        return [
            'reportable_id' => Candidate::query()->inRandomOrder()->first()->id,
            'reportable_type' => Candidate::class,
            'created_by' => null,
            'salary_received' => 'yes',
            'salary_date' => $dated,
            'remarks' => $this->faker->paragraph,
            'created_at' => $dated,
            'updated_at' => $dated,
        ];
    }
}
