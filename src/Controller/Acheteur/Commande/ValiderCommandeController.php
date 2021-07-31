<?php

namespace App\Controller\Acheteur\Commande;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\MesServices\CartServices\CartService;
use App\Repository\AdresseRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValiderCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/validate", name="profile_commande_validate")
     */
    public function validate(CartService $cartService, EntityManagerInterface $em, 
                    MailerInterface $mailer, AdresseRepository $adresseRepository)
    {

        /* process de paiement si success faire la suite*/
        
        /** @var User $user */
        $user = $this->getUser();
        $adresseLivraison = $adresseRepository->getAdresseLivraison($user);

        /** @var Commande $commande */
        $commande = new Commande();
        $commande->setCreatedAt(new \DateTime());
        $commande->setUser($user);
        $commande->setTotal($cartService->getTotal());
        $commande->setStatus('a-facturer');

        $em->persist($commande);

        $tabLigneCommandes = [];

        $panier = $cartService->show();

        foreach($panier as $item)
        {
            /** @var LigneCommande $ligneCommande */
            $ligneCommande = new LigneCommande();
            $ligneCommande->setProduit($item['produit']);
            $ligneCommande->setQuantite($item['qte']);
            $ligneCommande->setSousTotal($item['produit']->getPrix() * $item['qte']);
            $ligneCommande->setCommande($commande);

            $tabLigneCommandes[] = $ligneCommande;
            $em->persist($ligneCommande);
        }
        $em->flush();

        // envoi d'un email de notification à l'acheteur, au vendeur et à l'admin
        $emailVendeur = new TemplatedEmail();

        $emailVendeur->to( $panier[0]['produit']->getBoutique()->getVendeur()->getEmail() )
        ->addTo($user->getEmail())
        ->cc('maurice.henriet@yahoo.fr')
        ->from($user->getEmail())
        ->subject(
            'nouvelle commande sur le marché virtuel - boutique '.
            $panier[0]['produit']->getBoutique()->getNom().
            ' par l\'acheteur '.$user->getFirstName().' '.
            $user->getName().'.')
        ->htmlTemplate('email/commande_confirmation.html.twig')
        ->context([
            'commande' => $commande,
            'lignes' => $tabLigneCommandes,
            'acheteur' => $user,
            'adresseLivraison' => $adresseLivraison,
            'boutique' => $panier[0]['produit']->getBoutique()
        ]);

        $mailer->send($emailVendeur);

        $cartService->empty();

        $this->addFlash('success', 'Vous venez de passer une commande à '.$panier[0]['produit']->getBoutique()->getNom().'. 
            Vous recevrez une confirmation par email, ainsi que la facture à payer de la part du vendeur.');

        return $this->redirectToRoute('profile_personnel');

    }
}