<?php

namespace Blog\Service;

use Blog\Model\Comment;
use Blog\Repository\CommentRepositoryInterface;

class CommentService
{
    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param int $articleId
     * @return Comment[]
     */
    public function getAllCommentsForArticle(int $articleId): array
    {
        return $this->commentRepository->getAllByArticleId($articleId);
    }

    public function createNewComment(string $username, string $content, int $articleId): void
    {
        $this->commentRepository->createNew($username, $content, $articleId);
    }
}
