<?php

namespace App\Views\Forms\Auth;

use App\App;
use Core\Views\Form;

class LogoutForm extends Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'method' => 'POST',
                'class' => 'log-out-btn',
            ],
            'buttons' => [
                'log_out' => [
                    'text' => 'Log out',
                    'extra' => [
                        'attr' => [
                            'class' => 'submit-button',
                        ]
                    ]
                ]
            ],
        ];

        parent::__construct($form);
    }

    public function logout():void
    {
        App::$session->logout();
        header('Location: /');
    }
}