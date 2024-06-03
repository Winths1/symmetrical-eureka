<?php

namespace App\Document;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document]
#[ApiResource()]
class Book
{
    #[MongoDB\Id]
    protected $id;

    #[MongoDB\Field(type: "string")]
    protected $title;

    #[MongoDB\ReferenceOne(
        targetDocument: Author::class, 
        inversedBy: "books",
        nullable: true
    )]
    protected $author;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
}