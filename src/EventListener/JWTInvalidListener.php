<?php

// src/App/EventListener/JWTInvalidListener.php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTInvalidListener
{

    /**
     * @param JWTInvalidEvent $event
     */
    public function onJWTInvalid(JWTInvalidEvent $event)
    {
        $response = new JWTAuthenticationFailureResponse(
            'Harmony: Your token is invalid, please login again to get a new one',
            403
        );

        $event->setResponse($response);
    }

    /**
     * @param JWTNotFoundEvent $event
     */
    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        $data = [
            'status'  => '403 Forbidden',
            'message' => 'Harmony: Missing token',
        ];

        $response = new JsonResponse(
            $data,
            403
        );

        $event->setResponse($response);
    }
}
