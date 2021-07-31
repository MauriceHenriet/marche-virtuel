<?php

namespace App\Controller\Acheteur\Commande;

use App\MesServices\CartServices\CartService;
use App\Repository\AdresseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use function PHPUnit\Framework\returnSelf;

class CreateCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/create", name="profile_commande_create")
     */
    public function recap(CartService $cartService, AdresseRepository $adresseRepository)
    {
        $panier = $cartService->show();

        if(count($panier) === 0)
        {
            $this->addFlash('warning', 'Votre panie est vide.');
            return $this->redirectToRoute('cart_show');
        }

        $total = $cartService->getTotal();
        $user = $this->getUser();
        $adresseLivraison = $adresseRepository->getAdresseLivraison($user);

        return $this->render('acheteur/commande/recap.html.twig', [
            'panier' => $panier,
            'total' => $total,
            'adresse' => $adresseLivraison

        ]);
    }
}