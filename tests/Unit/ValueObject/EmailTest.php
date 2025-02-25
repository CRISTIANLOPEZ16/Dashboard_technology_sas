<?php

namespace Tests\Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Email;
use App\Domain\Exception\InvalidEmailException;

class EmailTest extends TestCase
{
    public function test_valid_email_creates_instance()
    {
        $email = new Email("test@example.com");
        $this->assertEquals("test@example.com", $email->getValue());
    }

    public function test_invalid_email_throws_exception()
    {
        $this->expectException(InvalidEmailException::class);
        new Email("invalid-email");
    }
}
