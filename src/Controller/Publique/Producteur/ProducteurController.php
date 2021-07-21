<?php

namespace App\Controller\Publique\Producteur;

use App\Repository\BoutiqueRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProducteurController extends AbstractController
{
    /**
     * @Route("/producteur/{producteurSlug}/{id}", name="producteur")
     */
    public function liste(int $id, BoutiqueRepository $boutiqueRepository)
    {
        $producteur = $boutiqueRepository->find($id);

        if(!$producteur)
        {
            $this->addFlash('warning', 'Ce producteur n\'existe pas.');
            return $this->redirectToRoute("liste_producteur");
        }

        return $this->render('public/producteur/producteur.html.twig', [
            'producteur' => $producteur
        ]);
    }
}