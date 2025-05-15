<?php

namespace App\view;

class ViewRender
{
    public function renderTemplate(string $template, array $params = []): false|string
    {
        extract($params);

        ob_start();
        require $template;
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . '/template/layout.php';
        return ob_get_clean();
    }
}