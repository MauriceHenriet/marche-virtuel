<?php

namespace App\Controller\Vendeur;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavSidebarController extends AbstractController
{
    /**
     * @Route("/vendeur/navsidebar", name="vendeur_navSidebar")
     */
    public function alert(CommandeRepository $commandeRepository)
    {
        $vendeur = $this->getUser();
        $boutiques = $vendeur->getBoutiques();

        $commandesAExpedier = [];
        $nbCommandesAExpedier = 0;

        foreach($boutiques as $boutique)
        {
            $commandesAExpedier = array_merge( $commandesAExpedier , $commandeRepository->findCommandesBoutiqueAExpedier($boutique) );
        }

        $nbCommandesAExpedier = count($commandesAExpedier);

        return $this->render('vendeur/shared/_navSidebar.html.twig', [
            'nbCommandesATraiter' => $nbCommandesAExpedier
        ]);
    }
}