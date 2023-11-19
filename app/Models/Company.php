<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 * @package App\Models
 * @property integer $id
 * @property string $company_name
 * @property string $vat_number
 * @property string $phone_number
 * @property string $email
 * @property integer $country_id
 * @property string $city
 * @property string $street
 * @property string $street_2
 * @property string $zipcode

 */
class Company extends Model
{
    use HasFactory;

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function deleteCompanyAndRelated()
    {
        $this->employees()->delete();
        $this->country()->delete();
        $this->projects()->delete();

        $this->delete();
    }
}
