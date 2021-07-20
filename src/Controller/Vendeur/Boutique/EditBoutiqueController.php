<?php

namespace App\Controller\Vendeur\Boutique;

use App\Repository\BoutiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\MesServices\ImageServices\SaveImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditBoutiqueController extends AbstractController
{
    /**
     * @Route("vendeur/boutique/edit/{id}", name="edit_boutique")
     */
    public function edit(int $id, Request $request,
        EntityManagerInterface $em, BoutiqueRepository $boutiqueRepository,
        SaveImageService $saveImageService):Response
    {
        # code...
    }
}