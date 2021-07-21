<?php

namespace App\Controller\Publique\Producteur;

use App\Repository\BoutiqueRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProducteurListeController extends AbstractController
{
    /**
     * @Route("/producteurs/", name="liste_producteur")
     */
    public function liste(BoutiqueRepository $boutiqueRepository):Response
    {
        $producteurs = $boutiqueRepository->findAll();

        // Filtrer :
        // ne pas afficher les producteurs en status : CLOSED

        return $this->render('public/producteur/liste_producteur.html.twig', [
            'producteurs' => $producteurs
        ]);
    }
}