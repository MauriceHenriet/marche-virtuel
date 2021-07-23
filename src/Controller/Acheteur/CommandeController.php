<?php

namespace App\Controller\Acheteur;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande", name="profile_commande")
     */
    public function recap()
    {



        return $this->render('acheteur/commande/recap.html.twig');
        // return $this->render('acheteur/commande/recap.html.twig', [
        //     'detailedCart' => $detailedCart,
        //     'total' => $total,
        //     'user' => $user

        // ]);
    }
}