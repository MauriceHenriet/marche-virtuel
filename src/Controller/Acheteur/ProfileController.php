<?php

namespace App\Controller\Acheteur;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/", name="profile_personnel")
     */
    public function home()
    {
        return $this->render('acheteur/home.html.twig');
    }
}