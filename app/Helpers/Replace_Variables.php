<?php

if (!function_exists('parseTemplate')) {
    function parseTemplate(string $template, array $data): string
    {
        return preg_replace_callback('/{{\s*(.*?)\s*}}/', function ($matches) use ($data) {
            $key = trim($matches[1]);

            return isset($data[$key])
                ? (string) $data[$key]
                : $matches[0];
        }, $template);
    }
}
