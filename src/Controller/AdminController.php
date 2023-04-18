<?php

namespace Blog\Controller;

use Blog\Model\Article;
use Blog\Response\HtmlResponse;
use Blog\Response\RedirectResponse;
use Blog\Response\Response;
use Blog\Service\ArticleService;
use Blog\Service\SecurityService;
use Blog\Utilities\ArticleHelper;
use Blog\Utilities\HtmlParser;

class AdminController
{
    private SecurityService $securityService;
    private ArticleService $articleService;

    public function __construct(SecurityService $securityService, ArticleService $articleService)
    {
        $this->securityService = $securityService;
        $this->articleService = $articleService;
    }

    public function viewLoginPage(bool $isError): Response
    {
        if ($this->securityService->isAuthorized()) {
            return new RedirectResponse('/admin/articles');
        }

        return new HtmlResponse(
            HtmlParser::parse(
                'admin\login.html',
                [
                    'error' => $isError ? 'Nieprawidlowe dane' : ''
                ]
            )
        );
    }

    public function viewArticlesPage(): Response
    {
        if (!$this->securityService->isAuthorized()) {
            return new RedirectResponse('/admin/login');
        }

        $articles = $this->articleService->getAllArticles();
        return new HtmlResponse(
            HtmlParser::parse(
                'admin\base.html',
                [
                    'content' => HtmlParser::parse(
                        'admin\articles.html',
                        [
                            'articles' => HtmlParser::parseMultiple(
                                'admin\article_single.html',
                                array_map(function (Article $article) {
                                    $data = $article->toArray();
                                    $data['content'] = ArticleHelper::shortContent($article->getContent());
                                    return $data;
                                }, $articles)
                            )
                        ]
                    )
                ]
            )
        );
    }

    public function createNewArticle(string $title, string $imgLink, string $origin, string $content): Response
    {
        if (!$this->securityService->isAuthorized()) {
            return new RedirectResponse('/admin/login');
        }

        $this->articleService->createNewArticle($title, $imgLink, $origin, $content);
        return new RedirectResponse('/admin/articles');
    }

    public function deleteArticle(int $id): Response
    {
        if (!$this->securityService->isAuthorized()) {
            return new RedirectResponse('/admin/login');
        }

        $this->articleService->deleteArticle($id);
        return new RedirectResponse('/admin/articles');
    }

    public function authorizeAdmin(string $login, string $password): Response
    {
        if ($this->securityService->authorizeAdmin($login, $password)) {
            return new RedirectResponse('/admin/articles');
        }

        return new RedirectResponse('/admin/login?error=1');
    }

    public function logoutAdmin(): Response
    {
        session_destroy();
        return new RedirectResponse('/');
    }
}
