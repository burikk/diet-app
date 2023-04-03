<?php

declare(strict_types=1);

namespace App\Tests\Unit\Enum;

use App\Enum\CountryBasePrice;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CountryBasePriceTest extends TestCase
{
    public function testCountryCodeEnumReturnsString(): void
    {
        foreach (CountryBasePrice::cases() as $case) {
            self::assertIsInt($case->value);
        }
    }

    public function testGetAllValuesCountsRightItems(): void
    {
        self::assertSame(4, count(CountryBasePrice::getAllValues()));
    }

    #[DataProvider('rightCountryBasePriceProvider')]
    public function testRightCountryCodeEnumExists(int $expectedPrice): void
    {
        self::assertTrue(in_array($expectedPrice, CountryBasePrice::getAllValues()));
    }

    public static function rightCountryBasePriceProvider(): array
    {
        return [
            [10], [50], [75], [150]
        ];
    }
}
