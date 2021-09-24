<?php

namespace App\Controller\Publique\Panier;

use Knp\Component\Pager\PaginatorInterface;
use App\MesServices\CartServices\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

// class CartShowController extends AbstractController
// {
//     /**
//      * @Route("/cart/show", name="cart_show")
//      */
//     public function show(CartService $cartService, Request $request,
//                     PaginatorInterface $paginatorInterface):Response
//     {
//         $panier = $cartService->show();

//         $panierPagi = $paginatorInterface->paginate(
//             $panier,
//             $request->query->getInt('page', 1),
//             5
//         );

//         return $this->render('public/cart/panier.html.twig', [
//             'panier' => $panier,
//             'panierPagi' => $panierPagi
//         ]);
//     }
// }
class CartShowController extends AbstractController
{
    /**
     * @Route("/cart/show", name="cart_show")
     */
    public function show(CartService $cartService):Response
    {
        $panier = $cartService->show();

        return $this->render('public/cart/panier.html.twig', [
            'panier' => $panier
        ]);
    }
}