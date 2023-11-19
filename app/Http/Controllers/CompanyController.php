<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{

    /** @var CompanyService */
    public CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(
            [
                'payload' => CompanyResource::collection(
                    Company::query()->with('country')->get()
                ),
                Response::HTTP_OK
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param CompanyStoreRequest $request
     * @return JsonResponse
     */
    public function store(CompanyStoreRequest $request): JsonResponse
    {
        $newCompany = $this->companyService->createCompany($request->validated());

        return new JsonResponse(['payload' => CompanyResource::make($newCompany)]);
    }

    /**
     * Display the specified resource.
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company $company): JsonResponse
    {
        return new JsonResponse(CompanyResource::make($company), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     * @param CompanyUpdateRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(CompanyUpdateRequest $request, Company $company): JsonResponse
    {
        $companyData = $this->companyService->updateCompany($company, $request->validated());

        return new JsonResponse(['payload' => CompanyResource::make($companyData)]);
    }

    /**
     * Remove the specified resource from storage.
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(Company $company): JsonResponse
    {
        $company->deleteCompanyAndRelated();

        return new JsonResponse([]);
    }
}
