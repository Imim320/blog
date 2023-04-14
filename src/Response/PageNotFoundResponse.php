<?php

namespace Blog\Response;

use Blog\Response\Response;

class PageNotFoundResponse extends Response
{
    public function __construct()
    {
        parent::__construct(404);
    }
}
