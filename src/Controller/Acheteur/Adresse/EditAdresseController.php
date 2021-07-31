<?php

namespace App\Controller\Acheteur\Adresse;

use App\Form\AdresseType;
use App\MesServices\RegionServices\CreateRegionService;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditAdresseController extends AbstractController
{
    /**
     * @Route("/profile/adresse/edit/{id}", name="edit_adresse")
     */
    public function edit(int $id, AdresseRepository $adresseRepository,
            CreateRegionService $createRegionService, Request $request, EntityManagerInterface $em):Response
    {
        $adresseToEdit = $adresseRepository->find($id);

        if(!$adresseToEdit)
        {
            $this->addFlash('danger', 'cette adresse n\'existe pas !' );
            return $this->redirectToRoute('profile_personnel');
        }

        $form = $this->createForm(AdresseType::class, $adresseToEdit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $createRegionService->createRegion($adresseToEdit);
            $em->flush();

            $this->addFlash('success', 'l\'adresse a bien été modifiée.');
            return $this->redirectToRoute('profile_personnel');
        }

        return $this->render('acheteur/adresse/edit.html.twig', [
            'formAdresse' => $form->createView()
        ]);
    }
}