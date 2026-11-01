<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Cookie;

#[AsEventListener(event: 'lexik_jwt_authentication.on_authentication_success')]
final class JwtCookieListener
{
    public function __invoke(AuthenticationSuccessEvent $event): void
    {
        $token = $event->getData()['token'] ?? null;

        if (!$token) {
            return;
        }

        $cookie = new Cookie(
            name: 'BEARER',
            value: $token,
            expire: new \DateTimeImmutable('+1 day'),
            path: '/',
            secure: true,
            httpOnly: true,
            sameSite: Cookie::SAMESITE_LAX,
        );

        $event->getResponse()->headers->setCookie($cookie);
        $event->setData(['message' => 'Connexion réussie']);
    }
}
