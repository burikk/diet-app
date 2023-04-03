<?php

declare(strict_types=1);

namespace App\Trait;

trait DietCalculationTrait
{
    public function getFixedAndRaisedAmount(int|float $basePrice, int $totalDays, int $daysUntilRaise, int|float $rateUp): int|float
    {
        $totalAmount = 0;

        if ($totalDays > 0 && $totalDays <= $daysUntilRaise) {
            $totalAmount += $basePrice * $totalDays;
        } elseif ($totalDays > $daysUntilRaise) {
            $totalAmount += $basePrice * $daysUntilRaise +
                $basePrice * $rateUp * ($totalDays - $daysUntilRaise);
        }

        return $totalAmount;
    }
}
