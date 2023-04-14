<?php

namespace Blog\Service;

use Blog\Repository\ArticleRepositoryInterface;
use Blog\Model\Article;

class ArticleService
{
    private ArticleRepositoryInterface $articleRepository;
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function createNewArticle(string $title, string $imgLink, string $origin, string $content): void
    {
        $this->articleRepository->new($title, $imgLink, $origin, $content);
    }

    public function deleteArticle(int $id): void
    {
        $this->articleRepository->delete($id);
    }

    public function getAllArticles(): array
    {
        return $this->articleRepository->getAll();
    }

    public function getArticleById(int $id): ?Article
    {
        return $this->articleRepository->getById($id);
    }
}
