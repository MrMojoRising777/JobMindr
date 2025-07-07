<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\ApplicationStatus;

class Application extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => ApplicationStatus::class,
    ];
    protected $fillable = [
        'user_id', 'company_id', 'position', 'description', 'found_on', 'status', 'applied_at', 'notes', 'link'
    ];

    public const STATUSES = [
        'applied',
        'interview',
        'offer',
        'rejected',
        'hired',
        'canceled',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
