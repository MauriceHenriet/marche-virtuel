<?php

namespace App\Controller\Acheteur\RoleVendeur;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditRoleVendeurController extends AbstractController
{
    /**
     * @Route("/profile/go_vendeur/", name="go_vendeur")
     */
    public function edit(Request $request,
                        EntityManagerInterface $em):Response
    {
        $user = $this->getUser();

        $user->setRoles(["ROLE_VENDEUR"]);

        $em->flush();

        $this->addFlash('success', 'Vous avez à présent les profils acheteur et vendeur, reconnectez vous:');

        return $this->redirectToRoute('profile_personnel');
    }

}