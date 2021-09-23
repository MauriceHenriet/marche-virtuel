<?php

namespace App\Controller\Publique\Produit;

use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitListeController extends AbstractController
{
    /**
     * @Route("/produits/", name="liste_produit")
     */
    public function liste(ProduitRepository $produitRepository, 
                    Request $request, PaginatorInterface $paginatorInterface):Response
    {
        $produits = $produitRepository->findAll();

        $produitsPagi = $paginatorInterface->paginate(
            $produits,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('public/produit/liste_produit.html.twig', [
            'produits' => $produits,
            'produitsPagi' => $produitsPagi
        ]);
    }
}