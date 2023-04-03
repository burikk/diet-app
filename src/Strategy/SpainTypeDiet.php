<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Enum\CountryBasePrice;
use App\Trait\DietCalculationTrait;

class SpainTypeDiet implements CountryTypeDietCalculator
{
    use DietCalculationTrait;

    private const DAYS_UNTIL_PRICE_DROP_1 = 3;
    private const RATE_DROP_1 = 50;
    private const DAYS_UNTIL_PRICE_DROP_2 = 5;
    private const RATE_DROP_2 = 25;

    public function __construct(private readonly CountryBasePrice $basePrice)
    {
    }

    public function calculateDiet(int $totalDays): int|float
    {
        return $this->getTwiceDroppedAmount(
            $this->basePrice->value, $totalDays,
            self::DAYS_UNTIL_PRICE_DROP_1,
            self::RATE_DROP_1,
            self::DAYS_UNTIL_PRICE_DROP_2,
            self::RATE_DROP_2
        );
    }
}
