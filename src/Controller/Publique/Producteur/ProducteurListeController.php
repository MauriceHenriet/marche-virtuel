<?php

namespace App\Controller\Publique\Producteur;

use App\Repository\BoutiqueRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProducteurListeController extends AbstractController
{
    /**
     * @Route("/producteurs/", name="liste_producteur")
     */
    public function liste(BoutiqueRepository $boutiqueRepository,
                            Request $request, PaginatorInterface $paginatorInterface):Response
    {
        $producteurs = $boutiqueRepository->findAll();

        $producteursPagi = $paginatorInterface->paginate(
            $producteurs,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('public/producteur/liste_producteur.html.twig', [
            'producteurs' => $producteurs,
            'producteursPagi' => $producteursPagi
        ]);
    }
}