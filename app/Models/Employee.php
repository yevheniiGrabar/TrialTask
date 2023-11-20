<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
