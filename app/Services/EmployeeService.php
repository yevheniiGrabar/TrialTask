<?php


namespace App\Services;


use App\Models\Employee;
use App\Traits\CurrentCompany;

class EmployeeService
{
    public function createEmployee(array $data): Employee
    {
        $employee = new Employee;

        $employee->name = $data['name'];
        $employee->job_title = $data['job_title'] ?? null;
        $employee->email = $data['email'];
        $employee->phone = $data['phone'] ?? null;
        $employee->company_id = $data['company_id'] ?? null;

        $employee->save();

        return $employee;
    }

    public function updateEmployee( array $data, $employee): Employee
    {
        $employee->update(
            [
                'name' => $data['name'] ?? $employee->name,
                'job_title' => $data['job_title'] ?? $employee->job_title,
                'email' => $data['email'] ?? $employee->email,
                'phone' => $data['phone'] ?? $employee->phone,
            ]
        );

        return $employee;
    }
}
