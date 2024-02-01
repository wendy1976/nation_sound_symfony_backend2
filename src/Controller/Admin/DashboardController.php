<?php

namespace App\Controller\Admin;


use App\Entity\Scene;
use App\Entity\Musique;
use App\Entity\DateConcert;
use App\Entity\Pass;
use App\Entity\Concert;
use App\Entity\ConcertPass;
use App\Entity\Notification;
use App\Entity\NotificationInfo;
use App\Entity\Location;
use App\Entity\SecurityInfo;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//Création de l'interface du tableau de bord pour le service administration
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Nation Sound - Gestion de contenu')
            ->renderContentMaximized();
    }
    # Toutes les fonctions, liens, icones etc du tableau de bord
    public function configureMenuItems(): iterable
{
    yield MenuItem::linktoDashboard('Accueil', 'fa fa-home');
    yield MenuItem::linkToCrud('Scenes', 'fas fa-theater-masks', Scene::class);
    yield MenuItem::linkToCrud('Musiques', 'fas fa-music', Musique::class);
    yield MenuItem::linkToCrud('Dates et horaires', 'fas fa-calendar-alt', DateConcert::class);
    yield MenuItem::linkToCrud('Les Pass', 'fas fa-ticket-alt', Pass::class);
    yield MenuItem::linkToCrud('Les Concerts', 'fas fa-microphone', Concert::class);
    yield MenuItem::linkToCrud('Les pass et les concerts', 'fas fa-guitar', ConcertPass::class);
    yield MenuItem::linkToCrud('Les notifications Alertes', 'fas fa-bell', Notification::class);
    yield MenuItem::linkToCrud('Les notifications Infos', 'fas fa-info', NotificationInfo::class);
    yield MenuItem::linkToCrud('La carte interactive', 'fas fa-map-marked-alt', Location::class);
    yield MenuItem::linkToCrud('Les informations de sécurité', 'fas fa-shield-alt', SecurityInfo::class);
    yield MenuItem::linkToCrud('Liste des utilisateurs', 'fa-solid fa-user', Utilisateur::class);
}







}
