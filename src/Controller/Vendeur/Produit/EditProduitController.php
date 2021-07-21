<?php

namespace App\Controller\Vendeur\Produit;

use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\MesServices\ImageServices\SaveImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditProduitController extends AbstractController
{
    /**
     * @Route("vendeur/produit/edit/{id}", name="edit_produit")
     */
    public function edit(int $id, ProduitRepository $produitRepository,
            EntityManagerInterface $em, Request $request,
            SaveImageService $saveImageService):Response
    {
        $produit = $produitRepository->find($id);

        if(!$produit)
        {
            $this->addFlash('warning', 'Ce produit n\'existe pas.');
            return $this->redirectToRoute("vendeur_home");
        }

        $imageOriginal = $produit->getImageUrl();

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $file = $form->get('imageUrl')->getData();

            $saveImageService->saveImage($file, $produit, $imageOriginal);
            
            $em->flush();

            $this->addFlash('success', 'Le produit '. $produit->getNom() .' a bien été modifié !');

            return $this->redirectToRoute('show_boutique', ['id' => $produit->getBoutique()->getId()]);
        }

        return $this->render('vendeur/produit/edit.html.twig', [
            'formProduit' => $form->createView(),
            'id' => $produit->getBoutique()->getId()
        ]);
    }
}