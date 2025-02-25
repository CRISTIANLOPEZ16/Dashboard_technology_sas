<?php

namespace Http\Controller;

abstract class BaseController
{
    protected function jsonResponse(array $data, int $statusCode = 200): void
    {
        header('Content-Type: application/json', true, $statusCode);
        echo json_encode($data);
        exit;
    }

    protected function jsonErrorResponse(string $message, int $statusCode = 400): void
    {
        $this->jsonResponse(['error' => $message], $statusCode);
    }
}
