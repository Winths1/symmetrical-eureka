<?php

namespace App\Document;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document]
#[ApiResource()]
class Author
{
    #[MongoDB\Id]
    protected $id;

    #[MongoDB\Field(type: "string")]
    protected $name;

    #[MongoDB\ReferenceMany(targetDocument: Book::class, mappedBy: "author")]
    protected Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}