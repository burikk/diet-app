<?php

declare(strict_types=1);

namespace App\Tests\Unit\Enum;

use App\Enum\CountryCode;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CountryCodeTest extends TestCase
{
    public function testGetAllValuesNotEmptyAndReturnsArray(): void
    {
        self::assertNotEmpty(CountryCode::getAllValues());
        self::assertIsArray(CountryCode::getAllValues());
    }

    public function testGetAllValuesCountsFourItems(): void
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

    public static function rightCountryCodeProvider(): array
    {
        return [
            ['PL'], ['DE'], ['GB'], ['ES']
        ];
    }
}
