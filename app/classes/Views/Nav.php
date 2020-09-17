<?php

namespace App\Views;

use App\App;
use App\Users\User;

class Nav extends \Core\View
{
    public function __construct($data = [])
    {
        $user = App::$session->getUser();

        if ($user) {
            $data = $this->getUserNav();
        } else {
            $data = $this->getAnonNav();
        }

        parent::__construct($data);
    }

    public function render($path = ROOT . '/app/templates/nav.tpl.php')
    {
        return parent::render($path);
    }

    public function getUserNav(): array
    {
        return [
            [
                'page' => 'home',
                'url' => '/'
            ],
        ];
    }

    public function getAnonNav(): array
    {
        return [
            [
                'page' => 'register',
                'url' => '/register',
            ],
            [
                'page' => 'log in',
                'url' => '/login',
            ],
        ];
    }
}
