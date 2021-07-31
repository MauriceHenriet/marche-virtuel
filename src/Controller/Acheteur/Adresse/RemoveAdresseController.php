<?php

namespace App\Controller\Acheteur\Adresse;

use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RemoveAdresseController extends AbstractController
{
    /**
     * @Route("/profile/adresse/remove/{id}", name="remove_adresse")
     */
    public function remove(int $id, AdresseRepository $adresseRepository,
            EntityManagerInterface $em):Response
    {
        $adresseToRemove = $adresseRepository->find($id);

        if(!$adresseToRemove)
        {
            $this->addFlash('danger', 'cette adresse n\'existe pas !' );
            return $this->redirectToRoute('profile_personnel');
        }

        $em->remove($adresseToRemove);
        $em->flush();

        $this->addFlash('success', 'Votre adresse a bien été supprimée.');

        return $this->redirectToRoute('profile_personnel');
    }
}