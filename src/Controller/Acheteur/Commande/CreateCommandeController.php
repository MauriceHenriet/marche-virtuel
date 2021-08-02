<?php

namespace App\Controller\Acheteur\Commande;

use App\MesServices\CartServices\CartService;
use App\Repository\AdresseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/create/{id}", name="profile_commande_create")
     */
    public function recap(int $id, CartService $cartService, AdresseRepository $adresseRepository)
    {
        $panier = $cartService->show();

        // on ne récupère que le panier de la commande pour la boutique
        foreach( $panier as $idBoutique => $panierBoutique)
        {
            if($id == $idBoutique) 
            {
                $panierBoutique = $panierBoutique;
                break;
            }    
        }

        if(count($panier) === 0)
        {
            $this->addFlash('warning', 'Votre panier est vide.');
            return $this->redirectToRoute('cart_show');
        }

        $user = $this->getUser();
        $adresseLivraison = $adresseRepository->getAdresseLivraison($user);

        return $this->render('acheteur/commande/recap.html.twig', [
            'panierBoutique' => $panierBoutique,
            'adresse' => $adresseLivraison
        ]);
    }
}