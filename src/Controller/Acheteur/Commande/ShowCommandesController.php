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

        $commandesAFacturer = $commandeRepository->findCommandesAcheteurAFacturer($user);

        $commandesAttentePaiement = $commandeRepository->findCommandesAcheteurAttentePaiement($user);

        $commandesPayees = $commandeRepository->findCommandesAcheteurAEnvoyer($user);

        $commandesLivraison = $commandeRepository->findCommandesAcheteurLivraison($user);

        $commandesLivree = $commandeRepository->findCommandesAcheteurLivree($user);

        $commandesAnnulee = $commandeRepository->findCommandesAcheteurAnnulee($user);

        $commandesRefusee = $commandeRepository->findCommandesAcheteurRefusee($user);

        return $this->render('acheteur/commande/show.html.twig', [
            'commandesAFacturer' => $commandesAFacturer,
            'commandesAttentePaiement' => $commandesAttentePaiement,
            'commandesPayees' => $commandesPayees,
            'commandesLivraison' => $commandesLivraison,
            'commandesLivree' => $commandesLivree,
            'commandesAnnulee' => $commandesAnnulee,
            'commandesRefusee' => $commandesRefusee
        ]);
    }
}