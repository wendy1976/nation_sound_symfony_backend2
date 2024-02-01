<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Admin;
use App\Form\AdminLoginFormType;
use ReCaptcha\ReCaptcha;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\VarDumper\VarDumper;
use Psr\Log\LoggerInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ["GET", "POST"])]
public function login(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em, LoggerInterface $logger): JsonResponse
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

#[Route('/admin/login', name: 'admin_login')]
public function adminLogin(Request $request, AuthenticationUtils $authenticationUtils)
{
    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();
    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    $form = $this->createForm(AdminLoginFormType::class, [
        'username' => $lastUsername,
    ]);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Votre logique de gestion de la soumission du formulaire ici

        // Rediriger l'utilisateur vers une autre page
        return $this->redirectToRoute('home');
    }

    return $this->render('admin/security/admin_login.html.twig', [
        'last_username' => $lastUsername,
        'error' => $error,
        'form' => $form->createView(),
    ]);
}


#[Route('/admin/logout', name: 'admin_logout')]
public function adminLogout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

}