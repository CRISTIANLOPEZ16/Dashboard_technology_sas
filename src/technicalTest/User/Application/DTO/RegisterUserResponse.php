<?php
namespace App\Application\DTO;
class RegisterUserResponse
{
    public string $id;
    public string $name;
    public string $email;
    public string $createdAt;

    public function __construct(string $id, string $name, string $email, string $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }
}