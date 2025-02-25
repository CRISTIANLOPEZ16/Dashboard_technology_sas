<?php

require 'vendor/autoload.php';

use Http\Controller\RegisterUserController;
use App\Application\UseCase\RegisterUserUseCase;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Infrastructure\Persistence\EntityManagerFactory;
use App\Domain\Event\DomainEventDispatcher;
use App\Application\Listener\SendWelcomeEmailListener;
use App\Domain\Event\UserRegisteredEvent;

// Crear instancia del EntityManager
$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// Crear repositorio de usuarios
$userRepository = new DoctrineUserRepository($entityManager);

// Crear dispatcher de eventos
$eventDispatcher = new DomainEventDispatcher();

// Crear y suscribir el listener al evento UserRegisteredEvent
$sendWelcomeEmailListener = new SendWelcomeEmailListener();
$eventDispatcher->subscribe(UserRegisteredEvent::class, $sendWelcomeEmailListener);

// Crear caso de uso con el dispatcher
$registerUserUseCase = new RegisterUserUseCase($userRepository, $eventDispatcher);

// Crear el controlador
$controller = new RegisterUserController($registerUserUseCase);

// Ejecutar la petición
$controller->handleRequest();
