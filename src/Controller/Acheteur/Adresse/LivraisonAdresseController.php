<?php

namespace App\Controller\Acheteur\Adresse;

use App\MesServices\AdresseServices\AdresseLivraisonService;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonAdresseController extends AbstractController
{
    /**
     * @Route("/profile/adresse/livraison/{id}", name="livraison_adresse")
     */
    public function livraison(int $id, AdresseRepository $adresseRepository, 
            AdresseLivraisonService $adresseLivraisonService,
            Request $request, EntityManagerInterface $em):Response
    {
        $adresseLivraison = $adresseRepository->find($id);

        if(!$adresseLivraison)
        {
            $this->addFlash('danger', 'cette adresse n\'existe pas !' );
            return $this->redirectToRoute('profile_personnel');
        }

        $adresseLivraisonService->setAdresseLivraison($adresseRepository, $adresseLivraison);

        $em->flush();

        $this->addFlash('success', 'l\'adresse de livraison a bien été choisie.');


        return $this->redirectToRoute('profile_personnel');
    }
}