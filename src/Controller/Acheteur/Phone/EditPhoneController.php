<?php

namespace App\Controller\Acheteur\Phone;

use App\Form\PhoneType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditPhoneController extends AbstractController
{
    /**
     * @Route("/profile/phone/edit", name="edit_phone")
     */
    public function edit(Request $request,
                        EntityManagerInterface $em):Response
    {
        $user = $this->getUser();

        $form = $this->createForm(PhoneType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();

            $this->addFlash('success', 'Votre numéro de téléphone a bien été modifié.');

            return $this->redirectToRoute('profile_personnel');
        }


        return $this->render('acheteur/phone/edit.html.twig', [
            'formPhone' => $form->createView()
        ] );
    }

}