<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Cookie;

#[AsEventListener(event: 'lexik_jwt_authentication.on_authentication_success')]
final class JwtCookieListener
{
    public function __construct(private RequestStack $requestStack) {}

    public function __invoke(AuthenticationSuccessEvent $event): void
    {
        $token = $event->getData()['token'] ?? null;

        if (!$token) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();
        $remember = $request?->getPayload()->getBoolean('remember') ?? false;

        $cookie = new Cookie(
            name: 'BEARER',
            value: $token,
            expire: $remember ? new \DateTimeImmutable('+1 day') : 0,
            path: '/',
            secure: true,
            httpOnly: true,
            sameSite: Cookie::SAMESITE_LAX,
        );

        $event->getResponse()->headers->setCookie($cookie);
        $event->setData(['message' => 'Connexion réussie']);
    }
}
