<?php

namespace Blog\Repository;

use Blog\Model\Comment;

interface CommentRepositoryInterface
{
    /**
     * @return Comment[]
     */
    public function getAllByArticleId(int $articleId): array;
    public function createNew(string $username, string $content, int $articleId): void;
}
