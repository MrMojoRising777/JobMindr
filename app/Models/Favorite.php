<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'favoritable_type', 'favoritable_id'];

    public function favoritable(): morphTo
    {
        return $this->morphTo();
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
