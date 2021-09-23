<?php

namespace App\Controller\Publique\Produit;

use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitCategorieController extends AbstractController
{
    /**
     * @Route("/categorie/{categorie}/produits/", name="produit_cat")
     */
    public function liste(Request $request, ProduitRepository $produitRepository, 
                string $categorie, PaginatorInterface $paginatorInterface):Response
    {
        $produits = $produitRepository->findByCategorie($categorie);

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