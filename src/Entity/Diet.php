<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\DietRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DietRepository::class)]
class Diet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 2)]
    private string $countryCode;

    #[ORM\Column]
    private int $totalDays;

    #[ORM\Column]
    private int $amount;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $dateStart;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $dateEnd;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTotalDays(): int
    {
        return $this->totalDays;
    }

    public function setTotalDays(int $totalDays): self
    {
        $this->totalDays = $totalDays;

        return $this;
    }

    public function getDateStart(): \DateTime
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTime $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): \DateTime
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTime $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }
}
