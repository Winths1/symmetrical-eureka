<?php

namespace App\Document;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Serializer\Attribute\Groups;

#[MongoDB\Document]
#[ApiResource(
    denormalizationContext: ['groups' => ['timegroup:write']],
)]
class WorkingDay
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: "string")]
    #[Groups(['timegroup:write'])]
    private string $name;


    #[MongoDB\EmbedMany(targetDocument: Period::class)]
    #[Groups(['timegroup:write'])]
    private iterable $periods;

    public function __construct()
    {
        $this->periods = new ArrayCollection();
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

    public function getPeriods(): iterable
    {
        return $this->periods;
    }

    public function addPeriod(Period $period): void
    {
        $this->periods[] = $period;
    }

    public function removePeriod(Period $period): void
    {
        $this->periods->removeElement($period);
    }
}