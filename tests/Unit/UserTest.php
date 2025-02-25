<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\Entity\User;

class UserTest extends TestCase
{
    public function testCreateUser(): void
    {
        $userId = new UserId(); // Cambio aquí
        $name = new Name("John Doe");
        $email = new Email("john.doe@example.com");
        $password = new Password("Str0ngP@ss!");
        $user = new User($userId, $name, $email, $password);
    
        $this->assertEquals($userId, $user->getId());
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertTrue($password->verify("Str0ngP@ss!"));
    }
}