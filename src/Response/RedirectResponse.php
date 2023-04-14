<?php

namespace Blog\Response;

class RedirectResponse extends Response
{
    public function __construct(string $url)
    {
        parent::__construct(302, $url);
    }
}
