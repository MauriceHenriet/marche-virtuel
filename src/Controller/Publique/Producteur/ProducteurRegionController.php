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
     * @Route("/producteurs", name="producteur_region")
     */
    public function listeRegionProducteur(Request $request ,string $region, BoutiqueRepository $boutiqueRepository):Response
    {
        $region = $request->query->get('region');

        dd($region);
        
        $producteurs = $boutiqueRepository->findByRegion($region);

        if(!$producteurs)
        {
            $this->addFlash('warning', 'Cette région n\'existe pas.');
            return $this->redirectToRoute("public_home");
        }

        // Filtrer :
        // ne pas afficher les producteurs en status : CLOSED

        return $this->render('public/producteur/region_producteur.html.twig', [
            'producteurs' => $producteurs
        ]);
    }
}