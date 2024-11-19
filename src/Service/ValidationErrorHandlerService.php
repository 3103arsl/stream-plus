<?php

// src/Service/ValidationErrorHandler.php
namespace App\Service;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ValidationErrorHandlerService
{
    /**
     * @param ConstraintViolationListInterface $errors
     * @return array
     */
    public function handleValidationErrors(ConstraintViolationListInterface $errors): array
    {
        $errorMessages = [];

        foreach ($errors as $error) {

            $field = $error->getPropertyPath();

            $errorMessages[] = [
                'field' => $field,
                'message' => $error->getMessage(),
            ];
        }

        return $errorMessages;
    }
}
