<?php

namespace App\Controllers\User;

use App\App;
use App\Views\Content;
use App\Views\Forms\Auth;

class ProfileController extends \App\Controllers\BaseController
{
   public function index(): ?string
    {
        $this->page->setTitle('Profile');
        if (empty(\App\App::$session->getUser())) {
            header('Location: /login');
        }

        $form = new Auth\LogoutForm();

        if ($form->isSubmitted() && $form->validate()) {
            $form->logout();
        }

        $user_id = App::$session->getUser()->getUserId();

        $user = App::$db->mySQL->query("SELECT * FROM users WHERE user_id='$user_id'")->fetch_object();

        $this->page->setContent((new Content([
            'name' => "{$user->name} {$user->last_name}",
            'email' => $user->email,
            'phone' => $user->phone,
            'register_time' => $user->registered_at,
            'login_time' => $user->last_login_at,
            'log_out_btn' => $form->render(),
        ]))->render('user/profile.tpl.php'));

        return $this->page->render();
    }

}