<?php

declare(strict_types=1);

namespace App\Request;

use App\Enum\CountryCode;
use Symfony\Component\Validator\Constraints as Assert;

class DietCreateRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(2)]
    #[Assert\Choice(callback: [CountryCode::class, 'getAllValues'])]
    protected string $countryCode;

    #[Assert\NotBlank]
    #[Assert\DateTime]
    protected string $dateStart;

    #[Assert\NotBlank]
    #[Assert\DateTime]
    #[Assert\GreaterThan(propertyPath: 'dateStart')]
    protected string $dateEnd;

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    public function getDateEnd(): string
    {
        return $this->dateEnd;
    }
}
