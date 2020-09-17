<?php

namespace App\Views\Forms\Auth;

use App\App;
use App\Users;
use Core\Views\Form;

class RegisterForm extends Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'method' => 'POST',
                'class' => 'auth-form',
            ],
            'fields' => [
                'name' => [
                    'type' => 'text',
                    'label' => 'First name',
                    'validators' => [
                        'validate_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'John',
                        ]
                    ],
                ],
                'last_name' => [
                    'type' => 'text',
                    'label' => 'Last name',
                    'validators' => [
                        'validate_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Doe',
                        ]
                    ],
                ],
                'email' => [
                    'type' => 'text',
                    'label' => 'Email',
                    'validators' => [
                        'validate_not_empty',
                        'validate_email',
                        'validate_email_unique'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'example@example.com',
                        ]
                    ]
                ],
                'phone' => [
                    'type' => 'text',
                    'label' => 'Phone',
                    'validators' => [
                        'validate_not_empty',
                        'validate_phone'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => '+37060000000',
                        ]
                    ]
                ],
                'password' => [
                    'type' => 'password',
                    'label' => 'Password',
                    'validators' => [
                        'validate_not_empty',
                        'validate_password_format'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'password',
                        ]
                    ]
                ],
                'password_repeat' => [
                    'type' => 'password',
                    'label' => 'Repeat password',
                    'validators' => [
                        'validate_not_empty',
                        'validate_password_format'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'password',
                        ]
                    ]
                ],
            ],
            'buttons' => [
                'register' => [
                    'text' => 'Register',
                    'extra' => [
                        'attr' => [
                            'class' => 'submit-button',
                        ]
                    ]
                ]
            ],
            'validators' => [
                'validate_fields_match' => [
                    'password',
                    'password_repeat'
                ]
            ]
        ];

        parent::__construct($form);
    }

    public function register():void
    {
        $user = new Users\User($this->getSubmitData());
        $password = password_hash($user->password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (email, name, last_name, phone, password)
                        VALUES ( '$user->email', '$user->name', '$user->last_name', '$user->phone', '$password')";
        if (App::$db->mySQL->query($query)){
            header('Location: /login');
        } else {
            print "Error: " . "<br>" . App::$db->mySQL->error;
        }
    }
}