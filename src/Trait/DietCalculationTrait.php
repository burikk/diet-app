<?php

declare(strict_types=1);

namespace App\Trait;

trait DietCalculationTrait
{
    public function getFixedAndRaisedAmount(
        int|float $basePrice,
        int $totalDays,
        int $daysUntilRaise,
        int|float $rateUp
    ): int|float {
        $totalAmount = 0;

        if ($totalDays > 0 && $totalDays <= $daysUntilRaise) {
            $totalAmount += $basePrice * $totalDays;
        } elseif ($totalDays > $daysUntilRaise) {
            $totalAmount += $basePrice * $daysUntilRaise +
                $basePrice * $rateUp * ($totalDays - $daysUntilRaise);
        }

        return $totalAmount;
    }

    public function getTwiceDroppedAmount(
        int|float $basePrice,
        int $totalDays,
        int $daysUntilDrop1,
        int|float $rateDrop1,
        int $daysUntilDrop2,
        int|float $rateDrop2
    ): int|float {
        $totalAmount = 0;

        if ($totalDays > 0 && $totalDays <= $daysUntilDrop1) {
            $totalAmount += $basePrice * $totalDays;
        } elseif ($totalDays > $daysUntilDrop1 && $totalDays <= $daysUntilDrop2) {
            $totalAmount += $basePrice * $daysUntilDrop1 +
                ($basePrice - $rateDrop1) * ($totalDays - $daysUntilDrop1);
        } elseif ($totalDays > $daysUntilDrop2) {
            $totalAmount += $basePrice * $daysUntilDrop1 +
                ($basePrice - $rateDrop1) * ($daysUntilDrop2 - $daysUntilDrop1) +
                ($basePrice - $rateDrop1 - $rateDrop2) * ($totalDays - $daysUntilDrop2);
        }

        return $totalAmount;
    }
}
