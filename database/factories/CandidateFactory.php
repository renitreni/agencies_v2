<?php

namespace Database\Factories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->bothify('#?#?'.now()->format('md').now()->format('y')),
            'photo_url' => 'https://i.pravatar.cc/300',
            'salary' => $this->faker->randomFloat(),
            'applied_using' => $this->faker->randomElement(['online', 'walk-in', 'agent']),
            'iqama' => $this->faker->creditCardNumber,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'contact_1' => $this->faker->phoneNumber,
            'contact_2' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'birth_date' => $this->faker->date,
            'birth_place' => $this->faker->address,
            'civil_status' => $this->faker->randomElement(['single', 'married', 'widow']),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'position_1' => $this->faker->jobTitle,
            'position_2' => $this->faker->jobTitle,
            'position_3' => $this->faker->jobTitle,
            'blood_type' => 'O',
            'height' => '5',
            'weight' => '100',
            'religion' => 'Jewish',
            'language' => $this->faker->randomElement(['english', 'tagalog']),
            'passport' => $this->faker->bankAccountNumber,
            'place_issue' => $this->faker->address,
            'education' => 'college',
            'spouse_name' => $this->faker->name,
            'mother_name' => $this->faker->name('female'),
            'father_name' => $this->faker->name('male'),
            'status' => 'applicant',
            'agreed' => 'yes',
            'travel_status' => $this->faker->randomElement(['ex-abroad', '1st time abroad']),
            'fb_account' => $this->faker->email,
            'skills' => $this->faker->jobTitle,
            'dos' => $this->faker->date(),
            'doe' => $this->faker->date(),
            'kin' => $this->faker->name,
            'kin_relationship' => 'relative',
            'kin_contact' => $this->faker->phoneNumber,
            'kin_address' => $this->faker->address,
        ];
    }
}
