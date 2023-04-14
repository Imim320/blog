<?php

namespace Blog\Model;

class Article
{
    private int $id;
    private string $title;
    private string $content;
    private string $imgLink;
    private string $author;
    private string $origin;

    public function __construct(int $id, string $title, string $content, string $imgLink, string $author, string $origin)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->imgLink = $imgLink;
        $this->author = $author;
        $this->origin = $origin;
    }

    public static function fromArray(array $arrayData)
    {
        return new self(
            $arrayData["id"],
            $arrayData["title"],
            $arrayData["content"],
            $arrayData["imgLink"],
            $arrayData["author"],
            $arrayData["origin"]
        );
    }

    public function toArray()
    {
        return [
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "content" => $this->getContent(),
            "imgLink" => $this->getImgLink(),
            "author" => $this->getAuthor(),
            "origin" => $this->getOrigin()
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getImgLink(): string
    {
        return $this->imgLink;
    }

    public function setImgLink(string $imgLink): void
    {
        $this->imgLink = $imgLink;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): void
    {
        $this->origin = $origin;
    }
}
