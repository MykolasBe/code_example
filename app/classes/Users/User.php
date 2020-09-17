<?php

namespace App\Users;

use Core\DataHolder;

class User extends DataHolder
{
    public function setUserId($user_id):void
    {
        $this->user_id = $user_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id ?? null;
    }


    /**
     * First name Set & Get
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }


    /**
     * Full name Set & Get
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name ?? null;
    }

    /**
     * Email Set & Get
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email ?? null;
    }

    /**
     * Password Set & Get
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): ?string
    {
        return $this->password ?? null;
    }


    /**
     * Phone Set & Get
     */
    public function setPhone(int $phone): void
    {
        $this->phone= $phone;
    }

    public function getPhone(): ?int
    {
        return $this->phone ?? null;
    }


    /**
     * Register time Set & Get
     */
    public function setRegistered(string $registered_at): void
    {
        $this->registered_at = $registered_at;
    }

    public function getRegistered(): ?string
    {
        return $this->registered_at ?? null;
    }


    /**
     * Last log in time Set & Get
     */
    public function setLastLogin(string $last_login_at): void
    {
        $this->last_login_at= $last_login_at;
    }

    public function getLastLogin(): ?string
    {
        return $this->last_login_at ?? null;
    }
}
