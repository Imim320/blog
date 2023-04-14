<?php

namespace Blog\Controller;

use Blog\Model\Article;
use Blog\Model\Comment;
use Blog\Response\PageNotFoundResponse;
use Blog\Response\RedirectResponse;
use Blog\Response\Response;
use Blog\Service\ArticleService;
use Blog\Service\CommentService;
use Blog\Utilities\HtmlParser;
use Blog\Utilities\ArticleHelper;
use Blog\Response\HtmlResponse;

class FrontController
{
    private ArticleService $articleService;
    private CommentService $commentsService;

    public function __construct(ArticleService $articleService, CommentService $commentsService)
    {
        $this->articleService = $articleService;
        $this->commentsService = $commentsService;
    }

    public function viewHomePage(): Response
    {
        $articles = $this->articleService->getAllArticles();

        return new HtmlResponse(
            HtmlParser::parse(
                'front\base.html',
                [
                    'content' => HtmlParser::parse(
                        'front\main_page.html',
                        [
                            'title' => null,
                            'content' => HtmlParser::parse(
                                'front\article_list.html',
                                [
                                    'content' => HtmlParser::parseMultiple(
                                        'front\article_thumbnail.html',
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
                ]
            )
        );
    }

    public function viewArticlePage($id): Response
    {
        $article = $this->articleService->getArticleById($id);

        if (!$article) {
            return new PageNotFoundResponse();
        }

        $comments = $this->commentsService->getAllCommentsForArticle($id);
        return new HtmlResponse(
            HtmlParser::parse(
                'front\base.html',
                [
                    'content' => HtmlParser::parse(
                        'front\article.html',
                        $article->toArray()
                    ),
                    'comments' => HtmlParser::parseMultiple(
                        'front\comment.html',
                        array_map(function (Comment $comment) {
                            return $comment->toArray();
                        }, $comments)
                    )
                ]
            )
        );
    }

    public function viewPageNotFoundPage(): Response
    {
        return new HtmlResponse(
            HtmlParser::parse(
                'front\base.html',
                ['content' => HtmlParser::parse('front\404.html')]
            )
        );
    }

    public function viewErrorPage(): Response
    {
        return new HtmlResponse(
            HtmlParser::parse(
                'front\base.html',
                ['content' => HtmlParser::parse('front\error.html')]
            )
        );
    }

    public function createNewArticle(string $username, string $content, int $articleId): Response
    {
        $this->commentsService->createNewComment($username, $content, $articleId);
        return new RedirectResponse(sprintf('/article/view/%s', $articleId));
    }
}
