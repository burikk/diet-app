<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Enum\CountryBasePrice;

interface CountryTypeDietCalculator
{
    public function __construct(CountryBasePrice $basePrice);

    public function calculateDiet(int $totalDays): int|float;
}
