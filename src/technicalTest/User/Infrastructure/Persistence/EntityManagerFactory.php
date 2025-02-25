<?php

namespace App\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

class EntityManagerFactory
{
    public function getEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . '/../../Domain/Entity'], // Directorio de entidades
            true // Modo desarrollo: true habilita el caché de metadatos
        );

        $connectionParams = [
            'dbname'   => getenv('MYSQL_DATABASE') ?: 'app_db',
            'user'     => getenv('MYSQL_USER') ?: 'root',
            'password' => getenv('MYSQL_PASSWORD') ?: 'dbgemelos2',
            'host'     => getenv('DB_HOST') ?: 'localhost',
            'driver'   => 'pdo_mysql',
        ];

        $conn = DriverManager::getConnection($connectionParams, $config);

        return new EntityManager($conn, $config);
    }
}
