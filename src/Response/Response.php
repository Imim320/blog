<?php

namespace Blog\Response;

abstract class Response
{
    private int $code;
    /** @var array|string  */
    private mixed $content;
    private string $type;

    public function __construct(int $code = 200, mixed $content = [], string $type = 'text/html')
    {
        $this->code = $code;
        $this->content = $content;
        $this->type = $type;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array|string
     */
    public function getContent(): mixed
    {
        return $this->content;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
