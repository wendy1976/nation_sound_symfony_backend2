<?php

namespace App\Controller\Admin;


use App\Entity\Scene;
use App\Entity\Musique;
use App\Entity\DateConcert;
use App\Entity\Pass;
use App\Entity\Concert;
use App\Entity\ConcertPass;
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
    yield MenuItem::linkToCrud('Scenes', 'fas fa-list', Scene::class);
    yield MenuItem::linkToCrud('Musiques', 'fas fa-list', Musique::class);
    yield MenuItem::linkToCrud('Dates et horaires', 'fas fa-list', DateConcert::class);
    yield MenuItem::linkToCrud('Les Pass', 'fas fa-list', Pass::class);
    yield MenuItem::linkToCrud('Les Concerts', 'fas fa-list', Concert::class);
    yield MenuItem::linkToCrud('Les pass et les concerts', 'fas fa-list', ConcertPass::class);
}
}
