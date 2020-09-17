<?php

\Core\Router::add('index',  '/', '\App\Controllers\User\ProfileController',  'index');

\Core\Router::add('register',  '/register', '\App\Controllers\Auth\RegisterController',  'index');
\Core\Router::add('login',  '/login', '\App\Controllers\Auth\LoginController',  'index');
\Core\Router::add('logout',  '/logout', '\App\Controllers\Auth\LogoutController',  'index');

\Core\Router::add('dashboard',  '/admin/dashboard', '\App\Controllers\Admin\DashboardController',  'index');
