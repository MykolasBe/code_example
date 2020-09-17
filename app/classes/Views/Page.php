<?php

namespace App\Views;

use App\Views;
use Core\View;

class Page extends View
{
    public function __construct(array $page = [])
    {
        $default = [
            'head' => [
                'title' => '',
                'css' => ['/assets/css/styles.css'],
                'js' => ['/assets/js/app.js']
            ],
            'header' => (new Views\Nav())->render(),
            'content' => '',
            'footer' => (new Views\Footer())->render()
        ];

        $this->data = $page + $default;

        parent::__construct($this->data);
    }

    /**
     * Sets (overrides) title in head
     *
     * @param string $title
     */
    function setTitle(string $title): void
    {
        $this->data['head']['title'] = $title;
    }

    /**
     * Sets (overrides) css in head
     *
     * @param string $css
     */
    function SetCss(string $css): void
    {
        $this->data['head']['css'] = [$css];
    }

    /**
     * Sets (overrides) js in head
     *
     * @param string $js
     */
    function SetJs(string $js): void
    {
        $this->data['head']['js'] = [$js];
    }

    /**
     * Sets (overrides) content in data
     *
     * @param string $content_html
     */
    function setContent(string $content_html): void
    {
        $this->data['content'] = $content_html;
    }

    public function render($template_path = 'page.tpl.php')
    {
        $path = ROOT . "/app/templates/$template_path";

        return parent::render($path);
    }


    /**
     * Sets content in data to empty
     */
    function deleteContent(): void
    {
        $this->data['content'] = '';
    }


    /**
     * Adds content in data without overriding
     *
     * @param string $content_html
     */
    function addContent(string $content_html): void
    {
        $this->data['content'] .= $content_html;
    }
}