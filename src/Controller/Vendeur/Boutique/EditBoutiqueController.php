<?php

namespace App\Controller\Vendeur\Boutique;

use App\Form\BoutiqueType;
use App\Repository\BoutiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\MesServices\ImageServices\SaveImageService;
use App\MesServices\RegionServices\CreateRegionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditBoutiqueController extends AbstractController
{
    /**
     * @Route("vendeur/boutique/edit/{id}", name="edit_boutique")
     */
    public function edit(int $id, Request $request,
        EntityManagerInterface $em, BoutiqueRepository $boutiqueRepository,
        SaveImageService $saveImageService, 
        CreateRegionService $createRegionService):Response
    {
        $boutique = $boutiqueRepository->find($id);

        if(!$boutique)
        {
            $this->addFlash('danger', 'Cette boutique n\'existe pas !');

            return $this->redirectToRoute('vendeur_home');
        }

        $imageOriginal = $boutique->getImageUrl();

        $form = $this->createForm(BoutiqueType::class, $boutique);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $file = $form->get('imageUrl')->getData();

            $saveImageService->saveImage($file, $boutique, $imageOriginal);
            $createRegionService->createRegion($boutique);

            $em->flush();

            $this->addFlash('success', 'La boutique '. $boutique->getNom() .' a bien été modifiée.');

            return $this->redirectToRoute('show_boutique', ['id' => $id]);
        }

        return $this->render('vendeur/boutique/edit.html.twig', [
            'formBoutique' => $form->createView(),
            'id'=>$id
        ]);
    }
}