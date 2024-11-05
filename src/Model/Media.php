<?php

namespace App\Model;

class Media {
    private string $title;
    private string $author;
    private bool $available;

    public function __construct(private $id, $title, $author, $available)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->available = $available;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getAvailable(): string
    {
        return $this->available;
    }

    public function setId($id): self
    {
        return $this->id = $id;
    }

    public function setTitle($title): self
    {
      return $this->title = $title;
    }

    public function setAuthor($author): self
    {
        return $this->author = $author;
    }

    public function setAvailable($available): self
    {
        return $this->available = $available;
    }

    public static function fromArray(array $data): self
    {
        return new static($data['id'], $data['title'], $data['author'], $data['available']);
    }
}
?>