<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email->getValue()]);   
    }

    public function delete(Email $email): void
    {
        $user = $this->findByEmail($email);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }
}
