<?php

namespace Blog\Service;

use Blog\Repository\ArticleRepository;

class AdminService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function login()
    {
    }
}
