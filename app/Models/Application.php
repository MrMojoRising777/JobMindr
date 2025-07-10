<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'properties'    => 'array',
        'status'        => ApplicationStatus::class,
        'reason'        => ApplicationRejectionReason::class,
    ];
    protected $fillable = ['user_id', 'company_id', 'position', 'properties', 'found_on', 'status', 'applied_at', 'notes', 'reason' ,'link'];

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
            ->logOnly(['status', 'reason', 'properties'])
            ->logOnlyDirty()
            ->useLogName('application')
            ->setDescriptionForEvent(function (string $eventName) {
                if ($eventName === 'created') {
                    return 'Applied';
                }

                if ($eventName === 'updated') {
                    $dirty = $this->getDirty();

                    if (array_key_exists('status', $dirty)) {
                        return 'Status updated';
                    }

                    if (array_key_exists('properties', $dirty)) {
                        return 'Properties edited';
                    }

                    return 'Application updated';
                }

                return "Application {$eventName}";
            });
    }

    protected function salaryRange(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->properties['salary_range'] ?? null,
            set: fn (string|null $value) => $this->mergeProperty('salary_range', $value),
        );
    }

    protected function jobType(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->properties['job_type'] ?? null,
            set: fn (string|null $value) => $this->mergeProperty('job_type', $value),
        );
    }

    protected function workLocation(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->properties['work_location'] ?? null,
            set: fn (string|null $value) => $this->mergeProperty('work_location', $value),
        );
    }

    protected function experienceLevel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->properties['experience_level'] ?? null,
            set: fn (string|null $value) => $this->mergeProperty('experience_level', $value),
        );
    }

    protected function educationLevel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->properties['education_level'] ?? null,
            set: fn (string|null $value) => $this->mergeProperty('education_level', $value),
        );
    }

    private function mergeProperty(string $key, mixed $value): array
    {
        return array_merge($this->properties ?? [], [$key => $value]);
    }
}
