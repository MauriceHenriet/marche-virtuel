<?php

namespace App\Controller\Vendeur\Produit;

use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\MesServices\ImageServices\SaveImageService;
use App\Repository\BoutiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateProduitController extends AbstractController
{
    /**
     * @Route("vendeur/produit/create/{id}", name="create_produit")
     */
    public function create(int $id, Request $request, EntityManagerInterface $em,
        SaveImageService $saveImageService,
        BoutiqueRepository $boutiqueRepository): Response
    {
        $boutique = $boutiqueRepository->find($id);
        if(!$boutique)
        {
            $this->addFlash('danger','Cette boutique n\'existe pas.');
            return $this->redirectToRoute('vendeur_home');
        }

        $form = $this->createForm(ProduitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Produit $produit */
            $produit = $form->getData();

            $file = $form->get('imageUrl')->getData();

            $saveImageService->saveImage($file, $produit);
            $produit->setBoutique($boutique);

            $em->persist($produit);
            $em->flush();

            $this->addFlash('success', 'Le produit a bien été ajouté dans la boutique !');

            return $this->redirectToRoute('show_boutique', [ 'id'=> $id] );
        }

        return $this->render('vendeur/produit/create.html.twig', [
            'formProduit' => $form->createView()
        ]);
    }

}