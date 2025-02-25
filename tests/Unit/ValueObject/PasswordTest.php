<?php

namespace Tests\Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Password;
use App\Domain\Exception\WeakPasswordException;

class PasswordTest extends TestCase
{
    public function test_valid_password_creates_instance()
    {
        $password = new Password("Str0sngP@ss!");
        $this->assertTrue($password->verify("Str0sngP@ss!"));
    }

    public function test_weak_password_throws_exception()
    {
        $this->expectException(WeakPasswordException::class);
        new Password("1234");
    }
}
