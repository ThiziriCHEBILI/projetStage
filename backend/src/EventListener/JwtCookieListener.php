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
        $token = $event->getData()['token'];

        $cookie = new Cookie(
            name: 'BEARER',
            value: $token,
            expire: new \DateTimeImmutable('+1 hour'),
            path: '/',
            secure: false,
            httpOnly: true,
            sameSite: Cookie::SAMESITE_LAX,
        );

        $event->getResponse()->headers->setCookie($cookie);
    }
}
