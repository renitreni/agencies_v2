<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'status' => $this->faker->randomElement(['back-out', 'deployed', 'in-process']),
            'source' => $this->faker->sentence,
            'requirements' => $this->faker->sentence,
            'passporting_allowance' => $this->faker->sentence,
            'ticket' => $this->faker->sentence,
            'tesda_allowance' => $this->faker->sentence,
            'nbi_renewal' => $this->faker->sentence,
            'pdos' => $this->faker->sentence,
            'info_sheet' => $this->faker->sentence,
            'medical_allowance' => $this->faker->sentence,
            'owwa_allowance' => $this->faker->sentence,
            'office_allowance' => $this->faker->sentence,
            'travel_allowance' => $this->faker->sentence,
            'weekly_allowance' => $this->faker->sentence,
            'medical_follow_up' => $this->faker->sentence,
            'nbi_refund' => $this->faker->sentence,
            'psa_refund' => $this->faker->sentence,
            'passport_refund' => $this->faker->sentence,
            'fare_refund' => $this->faker->sentence,
            'red_rebon_nbi' => $this->faker->sentence,
            'fit_to_work' => $this->faker->sentence,
            'repat' => $this->faker->sentence,
            'stamping' => $this->faker->sentence,
            'created_by' => $this->faker->sentence,
            'vaccine_fare' => $this->faker->sentence,
            'ticket_to_kuwait' => $this->faker->sentence,
            'ticket_to_qatar' => $this->faker->sentence,
        ];
    }
}
