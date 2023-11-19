<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed country
 * @property mixed projects
 * @property mixed employees
 */
class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->company_name,
            'country' => $this->whenLoaded('country', function () {
                return [
                    'id' => $this->resource->country->id,
                    'name' => $this->resource->country->name,
                ];
            }),
            'projects' => ProjectResource::collection($this->projects),
            'street' => $this->resource->street,
            'city' => $this->resource->city,
            'zipcode' => $this->resource->zipcode,
            'phone' => $this->resource->phone_number,
            'email' => $this->resource->email,
            'employees' => EmployeeResource::collection($this->employees),
        ];
    }
}
