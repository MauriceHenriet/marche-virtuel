<?php

namespace App\Controller\Publique\Producteur;

use App\Repository\BoutiqueRepository;
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
        BoutiqueRepository $boutiqueRepository):Response
    {
        $categorie = $request->query->get('cat');
        
        $producteurs = $boutiqueRepository->findBy( ['categorie' => $categorie ] );

        if(!$producteurs)
        {
            $this->addFlash('warning', 'Cette categorie n\'existe pas.');
            return $this->redirectToRoute("public_home");
        }

        // Filtrer :
        // ne pas afficher les producteurs en status : CLOSED

        return $this->render('public/producteur/liste_producteur.html.twig', [
            'producteurs' => $producteurs
        ]);
    }
}

