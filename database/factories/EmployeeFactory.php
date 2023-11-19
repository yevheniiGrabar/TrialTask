<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::query()->inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'job_title' => $this->faker->jobTitle,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
