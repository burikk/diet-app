<?php

declare(strict_types=1);

namespace App\Tests\Unit\Enum;

use App\Enum\CountryCode;
use App\Strategy\CountryTypeDietCalculator;
use App\Strategy\GermanyTypeDiet;
use App\Strategy\GreatBritainTypeDiet;
use App\Strategy\PolandTypeDiet;
use App\Strategy\SpainTypeDiet;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CountryCodeTest extends TestCase
{
    public function testGetAllValuesNotEmptyAndReturnsArray(): void
    {
        self::assertNotEmpty(CountryCode::getAllValues());
        self::assertIsArray(CountryCode::getAllValues());
    }

    public function testGetAllValuesCountsRightItems(): void
    {
        self::assertSame(4, count(CountryCode::getAllValues()));
    }

    public function testCountryCodeEnumReturnsString(): void
    {
        foreach (CountryCode::cases() as $case) {
            self::assertIsString($case->value);
        }
    }

    #[DataProvider('rightCountryCodeProvider')]
    public function testRightCountryCodeEnumExists(string $expectedCode): void
    {
        self::assertTrue(in_array($expectedCode, CountryCode::getAllValues()));
    }

    #[DataProvider('rightDietStrategyProvider')]
    public function TestIt(CountryCode $expectedCode, CountryTypeDietCalculator $countryTypeDietCalculator): void
    {
        self::assertEquals($expectedCode->matchDietStrategy(), $countryTypeDietCalculator);
    }

    public static function rightCountryCodeProvider(): array
    {
        return [
            ['PL'], ['DE'], ['GB'], ['ES']
        ];
    }

    public static function rightDietStrategyProvider(): array
    {
        return [
            [CountryCode::Poland, PolandTypeDiet::class],
            [CountryCode::Germany, GermanyTypeDiet::class],
            [CountryCode::GreatBritain, GreatBritainTypeDiet::class],
            [CountryCode::Spain, SpainTypeDiet::class],
        ];
    }
}
