<?php

namespace App\Controllers\Auth;
use App\Views\Forms\Auth;

class LoginController extends \App\Controllers\BaseController
{

    public function index(): ?string
    {
        $this->page->setTitle('Log in');

        $form = new Auth\LoginForm();

        if ($form->isSubmitted() && $form->validate()) {
            $form->login();
        }
        $this->page->setContent((new \App\Views\Content([
            'form' => $form,
            'h1' => 'Log in'
        ]))->render('auth/login.tpl.php'));

        return $this->page->render();
    }
}