<?php

namespace Blog\Utilities;

class HtmlParser
{
    private const TEMPLATE_LOCATION = 'C:\xampp\blog\templates\\';

    public static function parse(string $template, array $data = []): string
    {
        if (!file_exists(self::TEMPLATE_LOCATION . $template)) {
            throw new \Exception('File not exist');
        }

        $content = file_get_contents(self::TEMPLATE_LOCATION . $template);

        foreach ($data as $key => $value) {
            $content = str_replace(sprintf('{{%s}}', $key), $value, $content);
        }

        return $content;
    }

    public static function parseMultiple(string $template, array $data): string
    {
        $output = '';
        foreach ($data as $value) {
            $output = $output . self::parse($template, $value);
        }
        return $output;
    }
}
