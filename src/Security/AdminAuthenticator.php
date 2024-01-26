<?php

namespace App\Security;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\Authenticator\CsrfTokenClearingLogoutHandler;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class AdminAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    private UrlGeneratorInterface $urlGenerator;
    private EntityManagerInterface $entityManager;

    public function __construct(UrlGeneratorInterface $urlGenerator, EntityManagerInterface $entityManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->entityManager = $entityManager;
    }

    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === 'admin_login'
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request): array
    {
        return [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        $username = $credentials['username'];

        return $this->entityManager->getRepository(Admin::class)
            ->findOneBy(['username' => $username]);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        // You can add custom logic here to check the credentials
        // For example, if you have a custom password validation
        // return $user->getPassword() === $credentials['password'];

        // For simplicity, we're using Symfony's built-in password check
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('admin'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate('admin_login');
    }

    public function getPassword($credentials): ?string
    {
        return $credentials['password'];
    }

    public function createAuthenticatedToken(PassportInterface $passport, string $firewallName): PostAuthenticationGuardToken
    {
        return new PostAuthenticationGuardToken(
            $passport->getUser(),
            $firewallName,
            $passport->getUser()->getRoles()
        );
    }

    protected function getCredentialsClass(): string
    {
        return PasswordCredentials::class;
    }
}
