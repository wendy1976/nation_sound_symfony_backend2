<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Admin;
use App\Form\AdminLoginFormType;
use ReCaptcha\ReCaptcha; // Utilisé pour la validation du captcha
use Symfony\Component\HttpFoundation\Response; // Utilisé pour créer une réponse HTTP
use Symfony\Component\HttpFoundation\JsonResponse; // Utilisé pour créer une réponse JSON
use Doctrine\ORM\EntityManagerInterface; // Utilisé pour interagir avec la base de données via Doctrine
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe de base pour tous les contrôleurs Symfony
use Symfony\Component\HttpFoundation\Request; // Utilisé pour manipuler la requête HTTP entrante
use Symfony\Component\Routing\Annotation\Route; // Utilisé pour définir les routes avec des annotations
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken; // Utilisé pour représenter un jeton d'authentification basé sur le nom d'utilisateur et le mot de passe
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface; // Utilisé pour stocker et récupérer les jetons d'authentification
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils; // Utilisé pour récupérer les erreurs d'authentification et le dernier nom d'utilisateur entré
use Symfony\Component\HttpFoundation\Session\SessionInterface; // Utilisé pour manipuler la session HTTP
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Utilisé pour hacher les mots de passe utilisateur


use Symfony\Component\VarDumper\VarDumper;
use Psr\Log\LoggerInterface;

class SecurityController extends AbstractController
{

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/frontend/login', name: 'app_frontend_login', methods: ["GET","POST"])]
    public function handleUserLogin(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em, LoggerInterface $logger): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null || !isset($data['email']) || !isset($data['password'])) {
            return $this->json(['error' => 'Invalid request'], 400);
        }

        $email = $data['email'];
        $password = $data['password'];

        $user = $em->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);

        $logger->info('Checking password...');
            if (!$user || !$hasher->isPasswordValid($user, $password)) {
        $logger->info('Invalid credentials');
            return $this->json(['error' => 'Invalid credentials'], 400);
        }
        $logger->info('Password is valid');

        // handle successful login...
        $session = $request->getSession();
        $session->start();
        $session->set('user', $user);

            return $this->json(['status' => 'ok']);
    }


    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, EntityManagerInterface $em): JsonResponse
    {
        // Récupérez les données du formulaire de contact
        $data = json_decode($request->getContent(), true);

        // Vérifiez que $data n'est pas null et que 'recaptchaValue' existe dans $data
        if ($data === null || !isset($data['recaptchaValue'])) {
            return $this->json(['error' => 'Invalid request'], 400);
        }

        // Vérifiez le reCAPTCHA v2
        $recaptchaSecretKey = '6LcR51kpAAAAAD8ucJ-jww31A6QWYJbg6vhQVIsT';
        $recaptchaResponse = $data['recaptchaValue'];

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptchaData = [
            'secret' => $recaptchaSecretKey,
            'response' => $recaptchaResponse,
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($recaptchaData),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result, true);

        // Utilisez VarDumper pour afficher la réponse dans la console Symfony
        VarDumper::dump($result);
    
    
        // Vous devez adapter cette vérification en fonction de la réponse de reCAPTCHA v2
        if (isset($resultJson['success']) && $resultJson['success']) {
            // Traitez les autres données du formulaire de contact
            $fullName = $data['fullName'];
            $email = $data['email'];
            $subject = $data['subject'];
            $message = $data['message'];
            $agreement = $data['agreement'];

            // Traitez les données du formulaire ici
            // Par exemple, vous pouvez les enregistrer dans la base de données
            // ...

            return $this->json(['status' => 'ok']);
        }

        return $this->json(['error' => 'Invalid reCAPTCHA'], 400);
    }


    #[Route('/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em, LoggerInterface $logger): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $logger->info('Received data: ' . var_export($data, true));

        if ($data === null || !isset($data['email']) || !isset($data['password'])) {
            return $this->json(['error' => 'Invalid request'], 400);
        }

        // Créez une nouvelle instance de User
        $user = new Utilisateur();
        $user->setEmail($data['email']);
        $user->setPassword($hasher->hashPassword($user, $data['password']));
        $user->setNom($data['nom']); // Assurez-vous que 'nom' est fourni dans $data
        $user->setPrenom($data['prenom']); // Assurez-vous que 'prenom' est fourni dans $data
        $user->setEmailConfirmation($data['email']); 

        // Enregistrez l'utilisateur dans la base de données
        $em->persist($user);
        $em->flush();

        return $this->json(['status' => 'ok']);
    }
}