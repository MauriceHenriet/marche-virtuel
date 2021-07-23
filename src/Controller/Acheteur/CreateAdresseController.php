<?php

namespace App\Controller\Acheteur;

use App\Form\AdresseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\MesServices\RegionServices\CreateRegionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateAdresseController extends AbstractController
{
    /**
     * @Route("/profile/adresse/create", name="create_adresse")
     */
    public function create(Request $request, EntityManagerInterface $em, 
        CreateRegionService $createRegionService):Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AdresseType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Adresse $adresse */
            $adresse = $form->getData();

            $createRegionService->createRegion($adresse);
            $adresse->setUser($user);

            $em->persist($adresse);
            $em->flush();

            $this->addFlash('success', 'Votre adresse a bien été créée');

            return $this->redirectToRoute('profile_personnel');
        }




        return $this->render('acheteur/adresse/create.html.twig', [
            'formAdresse' => $form->createView()
        ]);
    }
}