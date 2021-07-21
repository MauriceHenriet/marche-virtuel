<?php

namespace App\Controller\Vendeur\Boutique;

use App\Repository\BoutiqueRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ShowBoutiqueController extends AbstractController
{
    /**
     * @Route("vendeur/boutique/show/{id}", name="show_boutique")
     */
    public function show(int $id, BoutiqueRepository $boutiqueRepository): Response
    {
        $boutique = $boutiqueRepository->find($id);

        if(!$boutique)
        {
            $this->addFlash('warning', 'Cette boutique n\'existe pas.');
            return $this->redirectToRoute("public_home");
        }

        return $this->render('vendeur/boutique/show.html.twig', [
            'boutique' => $boutique
        ]);
    }

}