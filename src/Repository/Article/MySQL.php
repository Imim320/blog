<?php

namespace Blog\Repository\Article;

use Blog\Repository\ArticleRepositoryInterface;
use Blog\Model\Article;
use Blog\Utilities\DBConnection;
use PDO;

class MySQL implements ArticleRepositoryInterface
{
    private DBConnection $dbConnection;

    public function __construct(DBConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function new(string $title, string $imgLink, string $origin, string $content): void
    {
        $sql = sprintf(
            "INSERT INTO article
    (title, content, imgLink, author, origin)
VALUES
    ('%s', '%s' ,'%s', '%s', '%s')",
            $title,
            $content,
            $imgLink,
            'Admin',
            $origin
        );

        $this->dbConnection->getPdo()->query($sql);
    }

    public function delete(int $id): void
    {
        $this->dbConnection->getPdo()->exec(
            sprintf('DELETE FROM `article` WHERE `id`=%s;', $id)
        );
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM article";
        $res = $this->dbConnection->getPdo()->prepare($sql);

        $res->execute();

        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        $output = [];

        foreach ($result as $item) {
            $output[] = Article::fromArray($item);
        }

        return $output;
    }

    public function getById(int $id): ?Article
    {
        $sql = "SELECT * FROM article WHERE id=$id";

        $res = $this->dbConnection->getPdo()->prepare($sql);
        $res->execute();

        $res = $res->fetch(PDO::FETCH_ASSOC);
        return (is_array($res)) ? Article::fromArray($res) : null;
    }
}
