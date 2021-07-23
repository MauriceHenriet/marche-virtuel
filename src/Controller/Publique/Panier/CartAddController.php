<?php

namespace App\Controller\Publique\Panier;

use App\Repository\ProduitRepository;
use App\MesServices\CartServices\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartAddController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add(CartService $cartService, int $id, 
            ProduitRepository $productRepository, Request $request)
    {
        $produit = $productRepository->find($id);

        if(!$produit)
        {
            $this->addFlash('warning', 'Ce produit n\'existe pas.');
            return $this->redirectToRoute('public_home');
        }

        $cartService->add($id);

        $this->addFlash('success', 'le produit '. $produit->getNom() .' a bien été ajouté au panier AJOUTER LA QUANTITE d\'ARTICLES et TOTAL PANIER.');

        // si on ajoute depuis la page producteur : on y retourne
        if( $request->query->get('producteur') =='ok'  )
        {
            return $this->redirectToRoute('producteur', [
                'id' => $produit->getBoutique()->getId(),
                'producteurSlug' => $produit->getBoutique()->getSlug()
            ]);
        }
        // si on ajoute depuis la page produit : on y retourne
        if( $request->query->get('produit') == 'ok' )
        {
            return $this->redirectToRoute('produit', [
                'id' => $produit->getId(),
                'produitSlug' => $produit->getSlug(),
                'producteurSlug' => $produit->getBoutique()->getSlug()
            ]);
        }
        // par défaut on retourne sur la page panier :
        return $this->redirectToRoute('cart_show');

    }
}