<?php

namespace Blog\Utilities;

use Blog\Controller\AdminController;
use Blog\Controller\FrontController;
use Blog\Response\Response;
use Blog\Response\PageNotFoundResponse;
use Blog\Validator\AdminInputValidator;
use Blog\Validator\FrontInputValidator;

class Router
{
    private const ROUTES = [
        'root' => '/\/$/',
        'article_view' => '/\/article\/view\/\d{1}/',
        'comment_new' => '/\/comment\/new/',
        'admin_login' => '/\/admin\/login/',
        'admin_authorize' => '/\/admin\/authorize/',
        'admin_articles' => '/\/admin\/articles/',
        'admin_article_new' => '/\/admin\/article\/new/',
        'admin_article_delete' => '/\/admin\/article\/delete\/\d{1}/',
        'admin_logout' => '/\/admin\/logout/',
        'not_found' => '/\/404$/',
        'error' => '/\/error$/'
    ];

    private AdminController $adminController;
    private FrontController $frontController;

    public function __construct(AdminController $adminController, FrontController $frontController)
    {
        $this->adminController = $adminController;
        $this->frontController = $frontController;
    }


    public function route(): Response
    {
        $request = new Request($_GET, $_POST, [], $_SERVER);
        switch ($this->matchRoute($request)) {
            case 'root':
                return $this->frontController->viewHomePage();
            case 'article_view':
                return $this->frontController->viewArticlePage(
                    (int)filter_var($request->getUri(), FILTER_SANITIZE_NUMBER_INT)
                );
            case 'comment_new':
                FrontInputValidator::assertNewCommentValidator($_POST);

                return $this->frontController->createNewArticle(
                    $_POST['commentUsername'],
                    $_POST['commentContent'],
                    (int)$_POST['articleId']
                );
            case 'admin_login':
                return $this->adminController->viewLoginPage(!empty($_GET['error'] ?? null));
            case 'admin_authorize':
                AdminInputValidator::assertAuthorizeValidator($_POST);
                return $this->adminController->authorizeAdmin($_POST['login'], $_POST['password']);
            case 'admin_articles':
                return $this->adminController->viewArticlesPage();
            case 'admin_article_new':
                AdminInputValidator::assertNewArticleValidator($_POST);

                return $this->adminController->createNewArticle(
                    $_POST['title'],
                    $_POST['imgLink'],
                    $_POST['origin'],
                    $_POST['content']
                );
            case 'admin_article_delete':
                return $this->adminController->deleteArticle(
                    (int)filter_var($request->getUri(), FILTER_SANITIZE_NUMBER_INT)
                );
            case 'admin_logout':
                return $this->adminController->logoutAdmin();
            case 'not_found':
                return $this->frontController->viewPageNotFoundPage();
            case 'error':
                return $this->frontController->viewErrorPage();
            default:
                return new PageNotFoundResponse();
        }
    }

    private function matchRoute(Request $request): ?string
    {
        foreach (self::ROUTES as $name => $pattern)
        {
            if (preg_match($pattern, $request->getUri()))
            {
                return $name;
            }
        }
        return null;
    }
}
