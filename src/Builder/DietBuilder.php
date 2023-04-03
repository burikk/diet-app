<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\Diet;
use App\Enum\CountryCode;
use App\Trait\AmountTransformTrait;

class DietBuilder
{
    use AmountTransformTrait;

    private CountryCode $countryCode;
    private \DateTimeImmutable $dateStart;
    private \DateTimeImmutable $dateEnd;
    private int $totalDays = 0;

    public function setCountryCode(CountryCode $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function setDateStart(\DateTimeImmutable $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function setDateEnd(\DateTimeImmutable $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function buildDiet(): Diet
    {
        $diet = new Diet();

        return $diet->setCountryCode($this->countryCode->value)
            ->setDateStart($this->dateStart)
            ->setDateEnd($this->dateEnd)
            ->setTotalDays($this->countDays($this->dateStart, $this->dateEnd))
            ->setAmount($this->amount($this->totalDays));
    }

    private function countDays(\DateTimeImmutable $dateStart, \DateTimeImmutable $dateEnd): int
    {
        if ($dateEnd->getTimestamp() - $dateStart->getTimestamp() < 28800) {
            return $this->totalDays;
        }

        while ($dateStart <= $dateEnd) {
            if ($dateStart->format('N') < 6 && $dateStart->format('H:i:s') >= '00:00:00' && ($dateEnd->getTimestamp() - $dateStart->getTimestamp()) >= 28800) {
                ++$this->totalDays;
            }
            $dateStart = $dateStart->modify('+1 day')->setTime(0, 0, 0);
        }

        return $this->totalDays;
    }

    private function amount(int $totalDays): int
    {
        return $this->toCents($this->countryCode
            ->matchDietStrategy()
            ->calculateDiet($totalDays));
    }
}
