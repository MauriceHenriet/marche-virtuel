<?php

namespace App\Controller\Publique\Producteur;

use App\Repository\BoutiqueRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProducteurCategorieController extends AbstractController
{
    /**
     * @Route("/categorie/producteurs", name="producteur_cat")
     */
    public function liste(Request $request, 
        BoutiqueRepository $boutiqueRepository,
        PaginatorInterface $paginatorInterface):Response
    {
        $categorie = $request->query->get('cat');
        
        $producteurs = $boutiqueRepository->findBy( ['categorie' => $categorie ] );

        $producteursPagi = $paginatorInterface->paginate(
            $producteurs,
            $request->query->getInt('page', 1),
            5
        );

        if(!$producteurs)
        {
            $this->addFlash('warning', 'Cette categorie n\'existe pas.');
            return $this->redirectToRoute("public_home");
        }

        return $this->render('public/producteur/liste_producteur.html.twig', [
            'producteurs' => $producteurs,
            'producteursPagi' => $producteursPagi
        ]);
    }
}

