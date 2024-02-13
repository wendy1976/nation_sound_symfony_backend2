<?php


// Controleur du formulaire d'inscription
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\Persistence\ManagerRegistry; // Utilisé pour récupérer vos gestionnaires d'entités
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe de base pour tous les contrôleurs Symfony
use Symfony\Component\HttpFoundation\Request; // Utilisé pour manipuler la requête HTTP entrante
use Symfony\Component\HttpFoundation\Response; // Utilisé pour créer une réponse HTTP
use Symfony\Component\Routing\Annotation\Route; // Utilisé pour définir les routes avec des annotations
use Symfony\Component\Uid\Uuid; // Utilisé pour générer des UUID
use Symfony\Component\Validator\Validator\ValidatorInterface; // Utilisé pour valider les données
use Symfony\Component\Mailer\MailerInterface; // Utilisé pour l'envoi d'e-mails
use Symfony\Component\Mime\Email as MimeEmail; // Utilisé pour la création d'e-mails
use Symfony\Component\Mailer\Exception\TransportExceptionInterface; // Utilisé pour la gestion des exceptions d'envoi d'e-mails
use Symfony\Component\Validator\Constraints\EqualTo; // Utilisé pour la validation de l'égalité des valeurs
use Symfony\Component\Form\FormError; // Utilisé pour les erreurs personnalisées dans les formulaires


class UtilisateurController extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route('/formutilisateur', name: 'formutilisateur')]
    public function index(Request $request, ManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $utilisateur = new Utilisateur();
        $utilisateurform = $this->createForm(UtilisateurType::class, $utilisateur);

        $utilisateurform->handleRequest($request);

        if ($utilisateurform->isSubmitted() && $utilisateurform->isValid()) {
            // Récupérer les valeurs des champs d'email et de confirmation
            $email = $utilisateurform->get('email')->getData();
            $emailConfirmation = $utilisateurform->get('emailConfirmation')->getData();

            // Vérifier si les champs d'email et de confirmation correspondent
            if ($email !== $emailConfirmation) {
                $utilisateurform->get('email')->addError(new FormError('Les adresses email doivent correspondre.'));
                $utilisateurform->get('emailConfirmation')->addError(new FormError('Les adresses email doivent correspondre.'));
            } else {
                // Les champs d'email et de confirmation correspondent, traitez l'inscription
                $entityManager = $doctrine->getManager();
                $entityManager->persist($utilisateur);
                $entityManager->flush();

                // Envoyer un e-mail à l'utilisateur
                $this->sendEmail($utilisateur);

                // Redirigez l'utilisateur vers la page de succès d'inscription
                return $this->redirectToRoute('inscription_succes');
            }
        }

        return $this->render('utilisateur/index.html.twig', [
            'utilisateurform' => $utilisateurform->createView(),
        ]);
    }

    #[Route('/inscription/success', name: 'inscription_succes')]
    public function inscriptionSucces(): Response
    {
        return $this->render('utilisateur/inscription_succes.html.twig');
    }

    private function sendEmail(Utilisateur $utilisateur): void
    {
        try {
            // Créez l'e-mail à envoyer
            $email = (new MimeEmail())
                ->from('caroline.ferru@free.fr') // Adresse expéditeur
                ->to($utilisateur->getEmail()) // Adresse destinataire
                ->subject('Confirmation d\'inscription')
                ->text('Merci de vous être inscrit.');

            // Envoyer l'e-mail
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            // Gestion des erreurs d'envoi de l'e-mail ici
            // Vous pouvez logger l'erreur ou afficher un message d'erreur à l'utilisateur
        }
    }
}
