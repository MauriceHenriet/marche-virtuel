<?php

namespace App\Controller\Publique\Producteur;

use App\Repository\BoutiqueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProducteurRegionController extends AbstractController
{
    /**
     * @Route("/region/producteurs", name="producteur_region")
     */
    public function liste(Request $request,
            BoutiqueRepository $boutiqueRepository):Response
    {
        $region = $request->query->get('region');

        $producteurs = $boutiqueRepository->findByRegion($region);

        if(!$producteurs)
        {
            $this->addFlash('warning', 'Il n\'y a pas de producteurs sur cette région.');

            return $this->redirectToRoute('public_home');
        }

        // Filtrer :
        // ne pas afficher les producteurs en status : CLOSED

        return $this->render('public/producteur/liste_producteur.html.twig', [
            'producteurs' => $producteurs
        ]);
    }
}