<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case Applied = 'applied';
    case Interview = 'interview';
    case Offer = 'offer';
    case Rejected = 'rejected';
    case Hired = 'hired';
    case Canceled = 'canceled';

    public function badgeClass(): string
    {
        return match($this) {
            self::Applied   => 'badge bg-warning',
            self::Interview => 'badge bg-primary',
            self::Offer     => 'badge bg-light',
            self::Rejected  => 'badge bg-danger',
            self::Hired     => 'badge bg-success',
            self::Canceled  => 'badge bg-secondary',
        };
    }

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
