<?php

namespace Blog\Response;

use Blog\Response\Response;

class HtmlResponse extends Response
{
    public function __construct(mixed $content)
    {
        parent::__construct(200, $content, 'text/html');
    }
}
