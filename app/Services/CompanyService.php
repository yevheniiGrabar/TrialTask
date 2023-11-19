<?php


namespace App\Services;


use App\Models\Company;
use App\Models\DeliveryAddress;
use App\Traits\CurrentCompany;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CompanyService
{
    /**
     * @param $data
     * @return Company
     */
    public function createCompany($data): Company
    {
        $company = new Company();
        $company->company_name = $data['company_name'];
        $company->vat_number = $data['vat_number'];
        $company->country_id = $data['country'] ?? null;
        $company->street = $data['street'];
        $company->street_2 = $data['street_2'] ?? null;
        $company->city = $data['city'];
        $company->zipcode = $data['zipcode'];
        $company->phone_number = $data['phone_number'];
        $company->email = $data['email'];
        $company->save();

        return $company;
    }

    public function updateCompany($company, array $data): Company
    {
        try{
            $company->update(
                [
                    'company_name' => $data['name'] ?? $company->company_name,
                    'vat_number' => $data['vat_number'] ?? $company->vat_number,
                    'industry_id' => $data['industry'] ?? $company->industry_id,
                    'country_id' => $data['country'] ?? $company->country_id,
                    'street' => $data['street'] ?? $company->street,
                    'street_2' => $data['street_2'] ?? $company->street_2,
                    'city' => $data['city'] ?? $company->city,
                    'zipcode' => $data['zipcode'] ?? $company->zipcode,
                    'phone_number' => $data['phone'] ?? $company->phone_number,
                    'email' => $data['email'] ?? $company->email,
                ]
            );

            return $company;
        }catch(\Throwable $e) {
            dd($e);
        }
    }
}
