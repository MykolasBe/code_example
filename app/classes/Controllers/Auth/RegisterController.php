<?php

namespace App\Controllers\Auth;
use App\Views\Forms\Auth;

class RegisterController extends \App\Controllers\BaseController
{

    public function index(): ?string
    {
        $this->page->setTitle('Register');
        $form = new Auth\RegisterForm();

        if ($form->isSubmitted() && $form->validate()) {
            $form->register();
        }
        $this->page->setContent($form->render());

        return $this->page->render();
    }
}