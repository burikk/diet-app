<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseRequest
{
    public function __construct(protected ValidatorInterface $validator)
    {
        $this->populate();

        if ($this->autoValidateRequest()) {
            $this->validate();
        }
    }

    public function validate(): void
    {
        $errors = $this->validator->validate($this);
        $messages = ['message' => 'validation_failed', 'errors' => []];

        foreach ($errors as $message) {
            $messages['errors'][] = [
                'property' => $message->getPropertyPath(),
                'value' => $message->getInvalidValue(),
                'message' => $message->getMessage(),
            ];
        }

        if (count($messages['errors']) > 0) {
            $response = new JsonResponse($messages, Response::HTTP_BAD_REQUEST);
            $response->send();
        }
    }

    private function populate(): void
    {
        foreach (Request::createFromGlobals()->toArray() as $property => $value) {
            if (property_exists($this, $property)) {
                try {
                    $this->{$property} = $value;
                } catch (\Throwable $ex) {
                    $response = new JsonResponse($ex->getMessage(), Response::HTTP_BAD_REQUEST);
                    $response->send();
                }
            }
        }
    }

    /**
     * Can be disabled per child class.
     */
    protected function autoValidateRequest(): bool
    {
        return true;
    }
}
