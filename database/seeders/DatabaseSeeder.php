<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Country;
use App\Models\Employee;
use App\Models\EmployeeProject;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::factory(20)->create();
        Company::factory(10)->create();
        Project::factory(40)->create();
        Employee::factory(100)->create();

    }
}
