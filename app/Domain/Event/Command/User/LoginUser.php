<?php

namespace App\Domain\Event\Command\User;

use App\Domain\Bus\Command\Command;

class LoginUser extends Command
{
    public function __construct(
        public string $email,
        public string $password
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}
