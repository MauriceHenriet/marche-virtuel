<?php

namespace App\Controller\Publique\Producteur;

use App\Repository\BoutiqueRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProducteurRegionController extends AbstractController
{
    /**
     * @Route("/producteurs/{region}", name="liste_producteur")
     */
    public function liste(string $region, BoutiqueRepository $boutiqueRepository):Response
    {
        $producteurs = $boutiqueRepository->findBy(
            ['region' => $region ]
        );

        // Filtrer :
        // ne pas afficher les producteurs en status : CLOSED

        return $this->render('public/producteur/liste_producteur.html.twig', [
            'producteurs' => $producteurs
        ]);
    }
}