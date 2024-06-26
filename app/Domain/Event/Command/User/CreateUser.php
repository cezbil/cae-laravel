<?php

namespace App\Domain\Event\Command\User;

use App\Domain\Bus\Command\Command;

class CreateUser extends Command
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
