<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'street', 'housenr', 'zipcode', 'city', 'region', 'website'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
