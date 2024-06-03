<?php

namespace App\Document;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Serializer\Annotation\Groups;

#[MongoDB\Document]
#[ApiResource(
    denormalizationContext: ['groups' => ['timegroup:write']],
)]
class Period
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: "string")]
    #[Groups(['timegroup:write'])]
    private string $name;

    #[MongoDB\Field(type: "date_immutable")]
    #[Groups(['timegroup:write'])]
    private \DateTimeImmutable $dateTimeImmutable;

    public function __construct()
    {
        $this->dateTimeImmutable = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDateTimeImmutable(): \DateTimeImmutable
    {
        return $this->dateTimeImmutable;
    }
}