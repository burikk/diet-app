<?php

declare(strict_types=1);

namespace App\Enum;

enum CountryCode: string
{
    case Poland = 'PL';
    case Germany = 'DE';
    case GreatBritain = 'GB';
    case Spain = 'ES';

    public static function getAllValues(): array
    {
        return array_column(CountryCode::cases(), 'value');
    }
}
