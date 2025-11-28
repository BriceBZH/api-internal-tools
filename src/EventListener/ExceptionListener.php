<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof NotFoundHttpException) {
            $message = $exception->getMessage() ?: 'Resource not found';
            $response = new JsonResponse([
                'error' => 'Tool not found',
                'message' => $message
            ], 404);

            $event->setResponse($response);
            return;
        }

        $errors = [];
        if (method_exists($exception, 'getErrors')) {
            foreach ($exception->getErrors() as $violation) {
                if ($violation instanceof ConstraintViolationInterface) {
                    $errors[$violation->getPropertyPath()] = $violation->getMessage();
                }
            }
        }

        if ($errors) {
            $response = new JsonResponse([
                'error' => 'Validation failed',
                'details' => $errors,
            ], JsonResponse::HTTP_BAD_REQUEST);

            $event->setResponse($response);
            return;
        }

        $response = new JsonResponse([
            'error' => 'Internal server error',
            'message' => $exception->getMessage(),
        ], JsonResponse::HTTP_BAD_REQUEST);

        $event->setResponse($response);
    }

}