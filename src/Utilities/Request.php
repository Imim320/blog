<?php


namespace Blog\Utilities;


class Request
{
    private array $query;
    private array $request;
    private array $attributes;
    private array $server;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $server = [])
    {
        $this->query = $query;
        $this->request = $request;
        $this->attributes = $attributes;
        $this->server = $server;
    }
    public function get(string $key): mixed
    {
        if (isset($this->attributes[$key]))
        {
            return $this->attributes[$key];
        }
        if (isset($this->query[$key]))
        {
            return $this->query[$key];
        }
        if (isset($this->request[$key]))
        {
            return $this->request[$key];
        }
        throw new \Exception('Nie znaleziono parametru');
    }

    public function addAttribute(string $key, string $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function getUri(): ?string
    {
        return $this->server['REQUEST_URI']??null;
    }


}