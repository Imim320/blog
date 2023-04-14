<?php

namespace Blog\Repository\Comment;

use Blog\Model\Comment;
use Blog\Repository\CommentRepositoryInterface;
use Blog\Utilities\DBConnection;
use PDO;

class MySQL implements CommentRepositoryInterface
{
    private DBConnection $dbConnection;

    public function __construct(DBConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * @return Comment[]
     */
    public function getAllByArticleId(int $articleId): array
    {
        $sql = "SELECT * FROM comment WHERE article_id = " . $articleId;
        $res = $this->dbConnection->getPdo()->prepare($sql);

        $res->execute();

        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        $output = [];

        foreach ($result as $item) {
            $output[] = Comment::fromArray($item);
        }

        return $output;
    }

    public function createNew(string $username, string $content, int $articleId): void
    {
        $this->dbConnection->getPdo()->exec(
            sprintf(
                "INSERT INTO `comment` (`username`, `content`, `article_id`) VALUES (%s, %s, %s);",
                $this->dbConnection->getPdo()->quote($username),
                $this->dbConnection->getPdo()->quote($content),
                $articleId
            )
        );
    }
}
