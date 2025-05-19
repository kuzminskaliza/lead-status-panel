<?php

namespace App\view;

use App\config\Config;

class ViewRender
{
    public function renderTemplate(string $templateName, array $params = []): false|string
    {
        $params = array_merge(
            $params,
            ['vendor_url' => Config::get('params')['vendor_url'] ?? '']
        );
        extract($params);

        ob_start();

        $templateFile = __DIR__ . '/template/' . $templateName . '.php';

        if (!file_exists($templateFile)) {
            $content = 'File not found' . $templateFile;
        } else {
            require $templateFile;
            $content = ob_get_clean();
        }

        ob_start();
        require __DIR__ . '/template/layout.php';
        return ob_get_clean();
    }
}