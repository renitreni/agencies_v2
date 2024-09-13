<?php

namespace Database\Factories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'logo_path' => 'https://placeholder.com/',
            'poea' => $this->faker->bankAccountNumber,
            'status' => 'active',
            'created_by' => 'seeder',
        ];
    }
}
