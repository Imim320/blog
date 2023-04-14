<?php

namespace Blog\Repository;

use Blog\Model\Article;

interface ArticleRepositoryInterface
{
    public function new(string $title, string $imgLink, string $origin, string $content): void;

    public function delete(int $id): void;

    public function getAll(): array;

    public function getById(int $id): ?Article;
}
