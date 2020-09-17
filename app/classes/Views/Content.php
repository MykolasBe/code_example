<?php

namespace App\Views;

use Core\View;

class Content extends View
{
    /**
     * Shortens template path
     *
     * @param string $template_path
     * @return mixed
     */
    public function render($template_path)
    {
        $path = ROOT . "/app/templates/content/$template_path";

        return parent::render($path);
    }

    public function getData():?array
    {
        return $this->data ?? null;
    }
}