<?php
namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Infrastructure\Persistence\EntityManagerFactory;

class UserRepositoryTest extends TestCase
{
    private $entityManager;
    private $userRepository;

    protected function setUp(): void
    {
        $this->entityManager = new EntityManagerFactory();
        $this->entityManager = $this->entityManager->getEntityManager();
        $this->userRepository = new DoctrineUserRepository($this->entityManager);
    }

    public function testSaveAndFindUser(): void
    {
        $userId = new UserId();
        $user = new User($userId, new Name("Jane Doe"), new Email("jane.dosdfe@example.com"), new Password("Str0ngP@ss!"));

        $this->userRepository->save($user);
        
        $retrievedUser = $this->userRepository->findByEmail($user->getEmail());

        $this->assertNotNull($retrievedUser);
        $this->assertEquals($userId, $retrievedUser->getId());
    }
}
