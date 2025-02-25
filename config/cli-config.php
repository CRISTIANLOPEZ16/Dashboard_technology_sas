<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use App\Infrastructure\Persistence\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);