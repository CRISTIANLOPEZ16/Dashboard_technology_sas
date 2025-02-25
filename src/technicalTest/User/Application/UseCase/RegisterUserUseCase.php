<?php

namespace App\Application\UseCase;

use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\Event\UserRegisteredEvent;
use App\Domain\Event\DomainEventDispatcher;
use Ramsey\Uuid\Uuid;
use Exception;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private DomainEventDispatcher $eventDispatcher;
    
    public function __construct(UserRepositoryInterface $userRepository, DomainEventDispatcher $eventDispatcher) {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }
    
    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        // Verificar si el usuario ya existe antes de crearlo
        if ($this->userRepository->findByEmail(new Email($request->email))) {
            throw new Exception("User already exists.");
        }

        // Generar un nuevo ID UUID y crear la entidad User
        $user = new User(
            new UserId(Uuid::uuid4()->toString()),
            new Name($request->name),
            new Email($request->email),
            new Password($request->password)
        );
        
        // Guardar en el repositorio
        $this->userRepository->save($user);
        
        // Disparar evento de usuario registrado
        $event = new UserRegisteredEvent($user);
        $this->eventDispatcher->dispatch($event);
        
        // Retornar DTO de respuesta
        return new UserResponseDTO(
            $user->getId()->getValue(),
            $user->getName()->getValue(),
            $user->getEmail()->getValue(),
            $user->getCreatedAt()->format('Y-m-d H:i:s')
        );
    }
}
