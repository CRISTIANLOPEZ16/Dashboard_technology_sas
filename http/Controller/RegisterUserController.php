<?php

namespace Http\Controller;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;
use Exception;

class RegisterUserController extends BaseController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function handleRequest(): void
    {
        try {
            // Obtener los datos JSON de la petición
            $inputData = json_decode(file_get_contents('php://input'), true);
            
            if (!is_array($inputData)) {
                $this->jsonErrorResponse('Invalid JSON input', 400);
                return;
            }

            // Validar que los campos obligatorios están presentes
            if (empty($inputData['name']) || empty($inputData['email']) || empty($inputData['password'])) {
                $this->jsonErrorResponse('Missing required fields', 400);
                return;
            }

            // Crear DTO con los datos de la solicitud
            $request = new RegisterUserRequest(
                $inputData['name'],
                $inputData['email'],
                $inputData['password']
            );

            // Ejecutar caso de uso y obtener UserResponseDTO
            $userResponseDTO = $this->registerUserUseCase->execute($request);

            // Responder con JSON y código 201 (Created)
            $this->jsonResponse([
                'id' => $userResponseDTO->id,
                'name' => $userResponseDTO->name,
                'email' => $userResponseDTO->email,
                'createdAt' => $userResponseDTO->createdAt
            ], 201);
        } catch (Exception $e) {
            $this->jsonErrorResponse($e->getMessage(), 500);
        }
    }

}
