<?php

namespace App\Controllers;

abstract class BaseController
{

    /**
     * Controller constructor.
     *
     * We can write logic common for all
     * other methods
     *
     * Goal is to prepare $page
     */
    public function __construct()
    {
        $page = [
            'head' => [
                'css' => ['media/assets/style/css/main.css'],
            ]
        ];
        $this->page = new \App\Views\Page($page);
    }

    /**
     * This method builds or sets
     * current $page content
     * renders it and returns HTML
     *
     * Add more CRUD methods if needed
     *
     * @return string|null
     */
    abstract function index(): ?string;
}