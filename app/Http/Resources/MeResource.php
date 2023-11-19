<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->removeMissingValues(
                [
                    'id' => $this->resource->id,
                    'name' => $this->resource->name,
                    'email' => $this->resource->email,
                    'created_at' => $this->resource->created_at,
                    'updated_at' => $this->resource->updated_at,
                    $this->mergeWhen(!empty($this->additional), $this->additional),
                ]
            ),
        ];
    }
}
