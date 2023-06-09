<?php

declare(strict_types=1);

namespace App\Service;

use App\Builder\DietBuilder;
use App\Entity\Diet;
use App\Enum\CountryCode;
use App\Repository\DietRepository;

readonly class DietService
{
    public function __construct(private DietRepository $dietRepository, private DietBuilder $dietBuilder)
    {
    }

    public function getDiets(): array
    {
        return [];
    }

    public function createDiet(string $countryCode, string $dateStart, string $dateEnd): Diet
    {
        $diet = $this->dietBuilder
            ->setCountryCode(CountryCode::from($countryCode))
            ->setDateStart(new \DateTimeImmutable($dateStart))
            ->setDateEnd(new \DateTimeImmutable($dateEnd))
            ->buildDiet();
        $this->dietRepository->save($diet, true);

        return $diet;
    }
}
