<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'street', 'housenr', 'zipcode', 'city', 'region', 'country', 'sector', 'website'];

    public function getFavoritableType(): string
    {
        return 'company';
    }

    public function contact(): hasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function applications(): hasMany
    {
        return $this->hasMany(Application::class);
    }

    public function favorites(): morphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}
