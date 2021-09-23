<?php

namespace App\Controller\Acheteur\Commande;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\MesServices\CartServices\CartService;
use App\Repository\AdresseRepository;
use App\Repository\BoutiqueRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PayerCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/payer/{id}", name="profile_commande_payer")
     */
    public function payer(int $id, CartService $cartService, EntityManagerInterface $em, 
                    MailerInterface $mailer, AdresseRepository $adresseRepository, BoutiqueRepository $boutiqueRepository)
    {        
        /** @var User $user */
        $user = $this->getUser();
        $adresseLivraison = $adresseRepository->getAdresseLivraison($user);

        /** @var Boutique $boutique */
        $boutique = $boutiqueRepository->find($id);

        if(!$boutique)
        {
            $this->addFlash('danger', 'Cette boutique n\'existe pas !');

            return $this->redirectToRoute('vendeur_home');
        }

        // on ne récupère que le panier de la commande pour la boutique
        $panier = $cartService->show();
        foreach( $panier as $idBoutique => $panierBoutique)
        {
            if($id == $idBoutique) 
            {
                $panierBoutique = $panierBoutique;
                break;
            }    
        }

        /** @var Commande $commande */
        $commande = new Commande();
        $commande->setCreatedAt(new \DateTime());
        $commande->setUser($user);
        $commande->setTotal($panierBoutique['total']);
        $commande->setStatus(Commande::A_EXPE);
        $commande->setBoutique($boutique);

        $em->persist($commande);

        $tabLigneCommandes = [];

        $panier = $cartService->show();

        foreach($panierBoutique['produits'] as $item)
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


        // l'admin envoie un email de notification à l'acheteur et au vendeur
        $emailCommande = new TemplatedEmail();

        $emailCommande->to( $panierBoutique['produits'][0]['produit']->getBoutique()->getVendeur()->getEmail() )
        ->addTo($user->getEmail())
        ->from('maurice.henriet@yahoo.fr')
        ->subject(
            'Nouvelle commande sur le marché virtuel - boutique '.
            $panierBoutique['produits'][0]['produit']->getBoutique()->getNom().
            ' par l\'acheteur '.$user->getFirstName().' '.
            $user->getName().'.')
        ->htmlTemplate('email/commande_paiement.html.twig')
        ->context([
            'commande' => $commande,
            'lignes' => $tabLigneCommandes,
            'acheteur' => $user,
            'adresseLivraison' => $adresseLivraison,
            'boutique' => $panierBoutique['produits'][0]['produit']->getBoutique()
        ]);

        $mailer->send($emailCommande);

        $cartService->removePanierBoutique($id);

        $this->addFlash('success', 'Vous venez de passer une commande au vendeur : '.$panierBoutique['produits'][0]['produit']->getBoutique()->getNom().'. 
            Vous recevrez le récapitulatif par email.');

        return $this->redirectToRoute('profile_commandes_show');

    }
}