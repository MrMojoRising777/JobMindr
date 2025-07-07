<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'street', 'housenr', 'zipcode', 'city', 'region', 'country', 'sector', 'website'];

    public function contact(): hasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function applications(): hasMany
    {
        return $this->hasMany(Application::class);
    }
}
