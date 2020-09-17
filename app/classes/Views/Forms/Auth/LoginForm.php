<?php

namespace App\Views\Forms\Auth;

use App\App;
use Core\Views\Form;

class LoginForm extends Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'method' => 'POST',
            ],
            'fields' => [
                'email' => [
                    'type' => 'text',
                    'label' => 'Email',
                    'validators' => [
                        'validate_not_empty',
                        'validate_email',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'example@example.com',
                        ]
                    ]
                ],
                'password' => [
                    'type' => 'password',
                    'label' => 'Password',
                    'validators' => [
                        'validate_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'password',
                        ]
                    ]
                ],
            ],
            'buttons' => [
                'log_in' => [
                    'text' => 'Log in',
                    'extra' => [
                        'attr' => [
                            'class' => 'submit-button',
                        ]
                    ]
                ]
            ],
            'validators' => [
                'validate_login'
            ]
        ];

        parent::__construct($form);
    }

    public function login():void
    {
        $email = $this->getSubmitValue('email');
        App::$session->login($email);

        $date = date("Y-m-d H:i:s");
        App::$db->mySQL->query("
            UPDATE users SET last_login_at='$date' WHERE email='$email'
            ");

        header('Location: /');
    }
}