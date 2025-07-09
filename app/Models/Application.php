<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\ApplicationStatus;
use App\Enums\ApplicationRejectionReason;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Application extends Model
{
    use HasFactory, LogsActivity;

    protected $casts = [
        'status' => ApplicationStatus::class,
        'reason' => ApplicationRejectionReason::class,
    ];
    protected $fillable = [
        'user_id', 'company_id', 'position', 'description', 'found_on', 'status', 'applied_at', 'notes', 'reason' ,'link'
    ];

    public const STATUSES = [
        'applied',
        'interview',
        'offer',
        'rejected',
        'hired',
        'canceled',
    ];

    public function getFavoritableType(): string
    {
        return 'application';
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function favorites(): morphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'reason'])
            ->logOnlyDirty()
            ->useLogName('application')
            ->setDescriptionForEvent(function (string $eventName) {
                return match ($eventName) {
                    'created' => 'Applied',
                    'updated' => 'Status updated',
                    default   => "Application {$eventName}",
                };
            });
    }
}
