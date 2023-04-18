<?php

namespace Blog\Validator;


use Webmozart\Assert\Assert;

class FrontInputValidator
{
    public static function assertNewCommentValidator(array $data): void
    {
        Assert::keyExists($data, 'articleId');
        Assert::keyExists($data, 'commentUsername');
        Assert::keyExists($data, 'commentContent');
        Assert::notEmpty($data['articleId']);
        Assert::notEmpty($data['commentUsername']);
        Assert::notEmpty($data['commentContent']);
    }
}