<?php

namespace App\Controller\Vendeur\Boutique;

use App\Entity\Boutique;
use App\Form\BoutiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\MesServices\ImageServices\SaveImageService;
use App\MesServices\RegionServices\CreateRegionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateBoutiqueController extends AbstractController
{
    /**
     * @Route("vendeur/boutique/create", name="create_boutique")
     */
    public function create(Request $request, EntityManagerInterface $em,
        SaveImageService $saveImageService, CreateRegionService $createRegionService): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(BoutiqueType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Boutique $boutique */
            $boutique = $form->getData();

            $file = $form->get('imageUrl')->getData();

            $saveImageService->saveImage($file, $boutique);
            $createRegionService->createRegion($boutique);
            $boutique->setVendeur($user);

            $em->persist($boutique);
            $em->flush();

            $this->addFlash('success', 'Votre boutique a bien été créée');

            return $this->redirectToRoute('vendeur_home');
        }

        return $this->render('vendeur/boutique/create.html.twig', [
            'formBoutique' => $form->createView()
        ]);
    }

}