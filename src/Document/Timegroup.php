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
class Timegroup
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: "string")]
    #[Groups(['timegroup:write'])]
    private string $name;

    #[MongoDB\EmbedMany(targetDocument: WorkingDay::class)]
    #[Groups(['timegroup:write'])]
    private iterable $workingDays;

    public function __construct()
    {
        $this->workingDays = new ArrayCollection();
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

    public function getWorkingDays(): iterable
    {
        return $this->workingDays;
    }

    public function addWorkingDay(WorkingDay $workingDay): void
    {
        $this->workingDays[] = $workingDay;
    }

    public function removeWorkingDay(WorkingDay $workingDay): void
    {
        $this->workingDays->removeElement($workingDay);
    }
}