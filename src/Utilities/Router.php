<?php

namespace Blog\Utilities;

use Blog\Controller\AdminController;
use Blog\Controller\FrontController;
use Blog\Response\Response;
use Blog\Response\PageNotFoundResponse;
use Webmozart\Assert\Assert;

class Router
{
    private AdminController $adminController;
    private FrontController $frontController;

    public function __construct(AdminController $adminController, FrontController $frontController)
    {
        $this->adminController = $adminController;
        $this->frontController = $frontController;
    }

    public function route(): Response
    {
        $request = $_SERVER['REQUEST_URI'];
        if (preg_match('/\/$/', $request)) {
            return $this->frontController->viewHomePage();
        }
        if (preg_match('/\/article\/view\/\d{1}/', $request)) {
            $request = $_SERVER['REQUEST_URI'];
            if (preg_match(('/\/article\/view\/\d{1}/'), $request)) {
                return $this->frontController->viewArticlePage(
                    (int)filter_var($request, FILTER_SANITIZE_NUMBER_INT)
                );
            }
        }
        if (preg_match('/\/comment\/new/', $request)) {
            Assert::keyExists($_POST, 'articleId');
            Assert::keyExists($_POST, 'commentUsername');
            Assert::keyExists($_POST, 'commentContent');
            Assert::notEmpty($_POST['articleId']);
            Assert::notEmpty($_POST['commentUsername']);
            Assert::notEmpty($_POST['commentContent']);

            return $this->frontController->createNewArticle(
                $_POST['commentUsername'],
                $_POST['commentContent'],
                (int)$_POST['articleId']
            );
        }
        if (preg_match('/\/admin\/login/', $request)) {
            return $this->adminController->viewLoginPage(!empty($_GET['error'] ?? null));
        }
        if (preg_match('/\/admin\/authorize/', $request)) {
            Assert::keyExists($_POST, 'login');
            Assert::keyExists($_POST, 'password');
            Assert::notEmpty($_POST['login']);
            Assert::notEmpty($_POST['password']);

            return $this->adminController->authorizeAdmin($_POST['login'], $_POST['password']);
        }
        if (preg_match('/\/admin\/articles/', $request)) {
            return $this->adminController->viewArticlesPage();
        }

        if (preg_match('/\/admin\/article\/new/', $request)) {
            Assert::keyExists($_POST, 'title');
            Assert::keyExists($_POST, 'imgLink');
            Assert::keyExists($_POST, 'origin');
            Assert::keyExists($_POST, 'content');
            Assert::notEmpty($_POST['title']);
            Assert::notEmpty($_POST['imgLink']);
            Assert::notEmpty($_POST['origin']);
            Assert::notEmpty($_POST['content']);

            return $this->adminController->createNewArticle(
                $_POST['title'],
                $_POST['imgLink'],
                $_POST['origin'],
                $_POST['content']
            );
        }

        if (preg_match('/\/admin\/article\/delete\/\d{1}/', $request)) {
            $request = $_SERVER['REQUEST_URI'];
            if (preg_match(('/\/admin\/article\/delete\/\d{1}/'), $request)) {
                return $this->adminController->deleteArticle(
                    (int)filter_var($request, FILTER_SANITIZE_NUMBER_INT)
                );
            }
        }
//        if (preg_match('/\/admin\/article\/edit\/\d{1}/', $request))
//        {
//            return $this->adminController->editArticle();
//        }
//        if (preg_match('/\/admin\/article\/save\/\d{1}/', $request))
//        {
//            return $this->adminController->saveArticle();
//        }
//        if (preg_match('/\/admin\/article\/delete\/\d{1}/', $request))
//        {
//            return $this->adminController->deleteArticle();
//        }
//        if (preg_match('/\/admin\/article\/login/', $request))
//        {
//            return $this->adminController->loginPage();
//        }

        if (preg_match('/\/404$/', $request)) {
            return $this->frontController->viewPageNotFoundPage();
        }

        if (preg_match('/\/error$/', $request)) {
            return $this->frontController->viewErrorPage();
        }

        return new PageNotFoundResponse();
    }
}
