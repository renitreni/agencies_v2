<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complains>
 */
class ComplainsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'agency' => null,
            'agency_id' => null,
            'foreign_agency' => null,
            'foreign_agency_id' => null,
            'company' => null,
            'company_id' => null,
            'full_name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => $this->faker->dateTimeBetween('-50 years', '-19 years'),
            'contact_person' => $this->faker->name,
            'national_id' => $this->faker->buildingNumber(),
            'passport' => $this->faker->buildingNumber(),
            'occupation' => $this->faker->jobTitle,
            'email_address' => $this->faker->safeEmail,
            'contact_number' => $this->faker->phoneNumber,
            'contact_number2' => $this->faker->phoneNumber,
            'address_abroad' => $this->faker->address,
            'employer_contact' => $this->faker->phoneNumber(),
            'complaint'=> $this->faker->paragraph(5),
            'image1' => $this->faker->imageUrl(),
            'image2' => $this->faker->imageUrl(),
            'image3' => $this->faker->imageUrl(),
            'actual_latitude' => $this->faker->latitude(),
            'actual_longitude' => $this->faker->longitude(),
            'created_at'=> $this->faker->dateTimeBetween('-1 years'),
        ];
    }
}
