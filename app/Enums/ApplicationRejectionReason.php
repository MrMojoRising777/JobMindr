<?php

namespace App\Enums;

enum ApplicationRejectionReason: string
{
    case NO_RESPONSE      = 'no_response';
    case NOT_QUALIFIED    = 'not_qualified';
    case LACK_OF_EXPERIENCE = 'lack_of_experience';
    case COMPANY_CLOSED   = 'company_closed';
    case POSITION_FILLED  = 'position_filled';
    case OTHER            = 'other';

    public function label(): string
    {
        return match ($this) {
            self::NO_RESPONSE        => 'No response',
            self::NOT_QUALIFIED      => 'Not qualified',
            self::LACK_OF_EXPERIENCE => 'Lack of experience',
            self::COMPANY_CLOSED     => 'Company closed',
            self::POSITION_FILLED    => 'Position filled',
            self::OTHER              => 'Other',
        };
    }
}
