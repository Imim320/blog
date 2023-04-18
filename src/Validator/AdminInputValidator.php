<?php
namespace Blog\Validator;


use Webmozart\Assert\Assert;

class AdminInputValidator
{
    public static function assertNewArticleValidator(array $data): void
    {
        Assert::keyExists($data, 'title');
        Assert::keyExists($data, 'imgLink');
        Assert::keyExists($data, 'origin');
        Assert::keyExists($data, 'content');
        Assert::notEmpty($data['title']);
        Assert::notEmpty($data['imgLink']);
        Assert::notEmpty($data['origin']);
        Assert::notEmpty($data['content']);
    }

    public static function assertAuthorizeValidator(array $data): void
    {
        Assert::keyExists($data, 'login');
        Assert::keyExists($data, 'password');
        Assert::notEmpty($data['login']);
        Assert::notEmpty($data['password']);
    }

}