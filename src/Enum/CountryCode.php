<?php

declare(strict_types=1);

namespace App\Enum;

use App\Strategy\CountryTypeDietCalculator;
use App\Strategy\GermanyTypeDiet;
use App\Strategy\GreatBritainTypeDiet;
use App\Strategy\PolandTypeDiet;
use App\Strategy\SpainTypeDiet;

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

    public function matchDietStrategy(): CountryTypeDietCalculator
    {
        return match($this) {
            self::Poland => new PolandTypeDiet($this->getCountryBasePrice()),
            self::Germany => new GermanyTypeDiet($this->getCountryBasePrice()),
            self::GreatBritain => new GreatBritainTypeDiet($this->getCountryBasePrice()),
            self::Spain => new SpainTypeDiet($this->getCountryBasePrice()),
        };
    }

    private function getCountryBasePrice(): CountryBasePrice
    {
        return match($this) {
            self::Poland => CountryBasePrice::Poland,
            self::Germany => CountryBasePrice::Germany,
            self::GreatBritain => CountryBasePrice::GreatBritain,
            self::Spain => CountryBasePrice::Spain,
        };
    }
}
