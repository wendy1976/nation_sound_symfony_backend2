<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse; // Utilisé pour créer une réponse de redirection
use Symfony\Component\HttpFoundation\Request; // Utilisé pour manipuler la requête HTTP entrante
use Symfony\Component\HttpFoundation\Response; // Utilisé pour créer une réponse HTTP
use Symfony\Component\Routing\Generator\UrlGeneratorInterface; // Utilisé pour générer des URL à partir de routes
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface; // Interface pour les jetons d'authentification
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator; // Classe de base pour les authentificateurs de formulaire de connexion
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge; // Badge pour la validation du jeton CSRF
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge; // Badge pour la fonctionnalité "Se souvenir de moi"
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge; // Badge pour l'utilisateur authentifié
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials; // Crédentials pour l'authentification par mot de passe
use Symfony\Component\Security\Http\Authenticator\Passport\Passport; // Passeport utilisé pour l'authentification
use Symfony\Component\Security\Http\SecurityRequestAttributes; // Attributs de requête pour la sécurité
use Symfony\Component\Security\Http\Util\TargetPathTrait; // Trait pour la gestion du chemin cible


class AppAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait; // Utilisation du trait TargetPathTrait pour obtenir et stocker le chemin cible

    public const LOGIN_ROUTE = 'app_login'; // Définition de la route de connexion

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    // Méthode pour authentifier l'utilisateur
    public function authenticate(Request $request): Passport
    {
        $username = $request->request->get('username', ''); // Récupération du nom d'utilisateur depuis la requête

        // Stockage du dernier nom d'utilisateur utilisé dans la session
        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $username);

        // Création d'un objet Passport contenant les informations d'identification de l'utilisateur et d'autres badges comme le jeton CSRF et le badge RememberMe
        return new Passport(
            new UserBadge($username), // Utilisation du nom d'utilisateur comme identifiant de l'utilisateur
            new PasswordCredentials($request->request->get('password', '')), // Utilisation du mot de passe fourni par l'utilisateur
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')), // Vérification du jeton CSRF
                new RememberMeBadge(), // Activation de la fonctionnalité "Se souvenir de moi"
            ]
        );
    }

    // Méthode exécutée après une authentification réussie
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Récupération du chemin cible si celui-ci existe dans la session
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath); // Redirection vers le chemin cible
        }

        // Redirection vers une route spécifique après une authentification réussie
        return new RedirectResponse($this->urlGenerator->generate('admin')); // Redirection vers la page d'administration par défaut
    }

    // Méthode pour obtenir l'URL de connexion
    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE); // Génération de l'URL de la page de connexion
    }
}
