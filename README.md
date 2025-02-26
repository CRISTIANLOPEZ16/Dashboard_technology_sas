# 🚀 Proyecto PHP con Arquitectura Hexagonal y Doctrine

Este proyecto implementa una arquitectura **hexagonal** con **DDD (Domain-Driven Design)** en PHP, utilizando **Doctrine ORM** para la persistencia y ejecutándose en **Docker**, se utiliza un **Bounded Context** relacionado a la informacion de la empresa definiendo que en este caso el **User** es nuestro dominio en este caso y un recurso externo **http** para que actue como adaptador segun lo que se dicta el patron de diseño de una arquitectura hexagonal y como funcionaria con algun otro framework, para el docker se utiliza **php-fpm** ya que es una base.

---

## 📌 Requisitos
- **Docker** y **Docker Compose** instalados.
- **Make** (Opcional, pero recomendado para facilitar comandos).

---

## 🛠 Instalación y Configuración

### 1️⃣ Clonar el repositorio
```sh
    git clone https://github.com/tu-usuario/tu-repo.git
    cd tu-repo
```

### 2️⃣ Construir y levantar los contenedores
```sh
    make build
```

### 3️⃣ Cargar el modelo a la base de datos
```sh
    make database
```
Esto aplicará las migraciones de Doctrine y creará las tablas necesarias en la base de datos.

---
## 🧪 Validacion de evento y prueba de la apllicacion
Para validar el evento del caso de uso y demas el docker expone una api en **http://127.0.0.1:8080/register** en lo cual se puede enviar un cuerpo como :
```json
{"name":"Cristian lopez","email":"newlifeF22sss2223@gmail.com","password":"Strs0ngP@ss!"}
```
Con lo cual podra validar el las excepciones y todo lo relacionado a la api, asu vez podra ver el evento simulado en la consola de docker daemon en el apartado de la aplicación php


## 🧪 Pruebas
Para ejecutar los **tests unitarios y de integración**, usa:
```sh
    make test
```

---

## 📂 Estructura del Proyecto
```plaintext
📦 src
 ├── 📂 technicalTest/User       # Código principal de la aplicación siguiendo DDD
 │  ├── 📂 Application          # Casos de uso y DTO, ListenerEvents
        ├── 📂 UseCase
        │   ├── RegisterUserUseCase.php
        ├── 📂 DTO
        │   ├── RegisterUserRequest.php
        │   ├── RegisterUserResponse.php
        ├── 📂 Listener
        │   ├── SendWelcomeEmailListener.php
 │  ├── 📂 Domain               # Entidades, Value Objects y eventos
        ├── 📂 Entity
        │   ├── User.php
        ├── 📂 ValueObject
        │   ├── UserId.php
        │   ├── Name.php
        │   ├── Email.php
        │   ├── Password.php
        ├── 📂 Repository
        │   ├── UserRepositoryInterface.php
        ├── 📂 Event
        │   ├── DomainEventDispatcher.php
        │   ├── DomainEventInterface.php
        │   ├── EventListenerInterface.php
        │   ├── UserRegisteredEvent.php
        ├── 📂 Exception       # Exepciones personalizadas
        │   ├── InvalidEmailException.php
        │   ├── WeakPasswordException.php
 │  ├── 📂Infrastructure       # Persistencia, controladores y dependencias externas
        ├── 📂 Controller
        │   ├── RegisterUserController.php
        ├── 📂 Persistencia
        │   ├── DoctrineUserRepository.php
        │   ├── EntityManagerFactory.php

 ├── 📂 http                # controladores HTTP
    ├── 📂 Controller
        ├── RegisterUserController.php
        ├── BaseController.php
 ├── 📂 tests               # Pruebas unitarias y de integración
    ├── 📂 Unit
        ├── UserTest.php
        ├── 📂 ValueObject
            ├── EmailTest.php
            ├── PasswordTest.php

    ├── 📂 Integration
        ├── UserRepositoryTest.php
 
 ├── DockerFile              # Configuración de Docker y servicios
 ├── docker-compose.yml      # Configuración de Docker y servicios
 ├── Makefile                # Comandos de automatización
 ├── composer.json           # dependencias a utilizar
 ├── index.php               # lanza la api
 ├── phpunit.xml             # estructura xml para las pruebas unitarias y de integración
 ├── docker-compose.yml      # Configuración de contenedores
 ├── README.md               # Documentación principal
```

---

