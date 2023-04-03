<?php

declare(strict_types=1);

namespace App\Trait;

trait AmountTransformTrait
{
    public function toCents(int|float $amount): int
    {
        return (int) round($amount, 2) * 100;
    }

    public function fromCents(int $amount): int|float
    {
        return $amount / 100;
    }
}
