<?php


use Blog\Controller\AdminController;
use Blog\Controller\FrontController;
use Blog\Service\ArticleService;
use Blog\Utilities\DBConnection;
use Blog\Utilities\Router;
use Blog\Repository\Article\MySQL as ArticleRepository;
use Blog\Repository\Comment\MySQL as CommentRepository;
use Blog\Service\CommentService;
use Blog\Service\SecurityService;

if (\PHP_SESSION_NONE === session_status()) {
    session_start();
}

require 'vendor/autoload.php';
$articleService = new ArticleService(
    new ArticleRepository(
        new DBConnection()
    )
);

$commentService = new CommentService(
    new CommentRepository(
        new DBConnection()
    )
);


$securityService = new SecurityService();
$router = new Router(
    new AdminController($securityService, $articleService),
    new FrontController($articleService, $commentService, $securityService)
);

try {

    $response = $router->route();
    if($response->getCode() === 200) {
        if(is_string($response->getContent())) {
            echo $response->getContent();
        } else {
            echo json_encode($response->getContent());
        }
    } elseif ($response->getCode() === 302) {
        header(sprintf('Location: %s', $response->getContent()));
    } elseif ($response->getCode() === 404) {
        header(sprintf('Location: %s', '/404'));
    } else {
        header(sprintf('Location: %s', '/error'));
    }

} catch (\Throwable $exception) {
    header(sprintf('Location: %s', '/error'));
}
