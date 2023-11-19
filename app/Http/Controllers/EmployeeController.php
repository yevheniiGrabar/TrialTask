<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{

    /** @var EmployeeService */
    public EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(['payload' => EmployeeResource::collection(Employee::all())]);
    }


    /**
     * Store a newly created resource in storage.
     * @param EmployeeStoreRequest $request
     * @return JsonResponse
     */
    public function store(EmployeeStoreRequest $request): JsonResponse
    {
        $newEmployee = $this->employeeService->createEmployee($request->validated());

        return new JsonResponse(['payload' => EmployeeResource::make($newEmployee)]);
    }

    /**
     * Display the specified resource.
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee): JsonResponse
    {
        return new JsonResponse(['payload' => EmployeeResource::make($employee)]);
    }

    /**
     * Update the specified resource in storage.
     * @param EmployeeUpdateRequest $request
     * @param Employee $employee
     * @return JsonResponse
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee): JsonResponse
    {
        $updatedEmployee = $this->employeeService->updateEmployee($request->validated(), $employee);

        return new JsonResponse(['payload' => EmployeeResource::make($updatedEmployee)]);
    }

    /**
     * Remove the specified resource from storage.
     * @param Employee $employee
     * @return JsonResponse
     */
    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return new JsonResponse([]);
    }
}
