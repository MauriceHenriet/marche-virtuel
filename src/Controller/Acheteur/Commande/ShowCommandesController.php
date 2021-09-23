<?php

namespace App\Controller\Acheteur\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ShowCommandesController extends AbstractController
{
    /**
     * @Route("/profile/commandes/show", name="profile_commandes_show")
     */
    public function showCommandes(CommandeRepository $commandeRepository):Response
    {
        $user = $this->getUser();

        $commandesPayees = $commandeRepository->findCommandesAcheteurAEnvoyer($user);

        $commandesLivraison = $commandeRepository->findCommandesAcheteurLivraison($user);

        $commandesLivree = $commandeRepository->findCommandesAcheteurLivree($user);

        return $this->render('acheteur/commande/show.html.twig', [

            'commandesPayees' => $commandesPayees,
            'commandesLivraison' => $commandesLivraison,
            'commandesLivree' => $commandesLivree
        ]);
    }
}