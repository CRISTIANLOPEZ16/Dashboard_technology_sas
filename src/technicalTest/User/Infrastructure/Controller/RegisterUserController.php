<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;
    
    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }
    
    public function handle(array $requestData): string
    {
        $request = new RegisterUserRequest(
            $requestData['name'],
            $requestData['email'],
            $requestData['password']
        );
        
        $this->registerUserUseCase->execute($request);
        
        return json_encode(["message" => "User registered successfully"]);
    }
}
