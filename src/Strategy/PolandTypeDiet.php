<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Enum\CountryBasePrice;
use App\Trait\DietCalculationTrait;

class PolandTypeDiet implements CountryTypeDietCalculator
{
    use DietCalculationTrait;

    private const DAYS_UNTIL_PRICE_RAISE = 3;
    private const RATE_UP = 2;
    public function __construct(private readonly CountryBasePrice $basePrice)
    {
    }

    public function calculateDiet(int $totalDays): int|float
    {
        return $this->getFixedAndRaisedAmount($this->basePrice->value, $totalDays, self::DAYS_UNTIL_PRICE_RAISE, self::RATE_UP);
    }
}
