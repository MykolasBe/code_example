<?php

namespace Core;

use App\App;
use App\Users\User;

/**
 * Class Session
 * @package Core
 */
class Session
{
    private $user;

    public function __construct()
    {
        $this->loginFromCookie();
    }

    /**
     * Log in user from _SESSION cookie saved info
     */
    private function loginFromCookie(): void
    {
        if ($_SESSION) {

            $email = $_SESSION['user_log_in']['email'];

            $this->login($email);
        }
    }

    /**
     * Log in user
     * Set _SESSION Cookie
     * Set $user
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email): bool
    {

        if (!$data = App::$db->mySQL->query(
            "SELECT * FROM users WHERE email='$email'"
        )) {
            $this->logout();

            return false;
        } else {
            $this->user = new User($data->fetch_array());
            $_SESSION['user_log_in'] = $this->user->_toArray();

            return true;
        }
    }

    /**
     * Get set $user
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Destroys _SESSION cookie and $user
     */
    public function logout(): void
    {
        session_destroy();
        setcookie('PHPSESSID','',1,'/');
        $_SESSION = [];
        unset($this->user);
    }

    public function userIs(int $role)
    {
        $user = $this->getUser();
        if ($user && $user->role == $role) {
            return true;
        }
    }
}