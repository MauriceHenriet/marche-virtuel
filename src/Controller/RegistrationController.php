<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        // depuis l'inscription Producteur ou l'inscription Consommateur
        $isVendeur = $request->query->get('vendeur');

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            // depuis l'inscription Producteur ou l'inscription Consommateur
            // et depuis l'inscription générale avec choix
            if( $isVendeur === 'yes' || $_POST['choice'] == 'yes' ){
                $user->setRoles([User::ROLE_VENDEUR]);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        if($isVendeur === "yes" || $isVendeur === "no")
        {
            return $this->render('registration/register-no-choice.html.twig', [
                'registrationForm' => $form->createView(),
            ]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
