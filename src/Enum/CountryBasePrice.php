<?php

declare(strict_types=1);

namespace App\Enum;

enum CountryBasePrice: int
{
    case Poland = 10;
    case Germany = 50;
    case GreatBritain = 75;
    case Spain = 150;

    public static function getAllValues(): array
    {
        return array_column(CountryBasePrice::cases(), 'value');
    }
}
