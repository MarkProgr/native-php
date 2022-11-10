<?php

namespace App\Views;

class View
{
    private $templatePath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function render(string $templateName, array $vars = []): string
    {
        extract($vars);

        ob_start();
        require $this->templatePath . '/' . $templateName . '.php';
        return ob_get_clean();
    }
}