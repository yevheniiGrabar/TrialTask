<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Industry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'vat_number' => $this->faker->ean13(),
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->companyEmail,
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'country_id' => Country::query()->inRandomOrder()->first()->id,
            'zipcode' => $this->faker->randomNumber(4,4),
        ];
    }
}
