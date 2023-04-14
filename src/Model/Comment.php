<?php

namespace Blog\Model;

class Comment
{
    private int $id;
    private string $username;
    private string $content;

    public function __construct(int $id, string $username, string $content)
    {
        $this->id = $id;
        $this->username = $username;
        $this->content = $content;
    }

    public static function fromArray(array $arrayData)
    {
        return new self(
            $arrayData["id"],
            $arrayData["username"],
            $arrayData["content"]
        );
    }

    public function toArray()
    {
        return [
            "id" => $this->getId(),
            "username" => $this->getUsername(),
            "content" => $this->getContent()
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
