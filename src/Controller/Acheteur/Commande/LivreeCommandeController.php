<?php

namespace App\Controller\Acheteur\Commande;

use App\Entity\Commande;
use App\Repository\AdresseRepository;
use App\Repository\CommandeRepository;
use App\Repository\LigneCommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreeCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/livree/{id}", name="profile_commande_livree")
     */
    public function livree(int $id, CommandeRepository $commandeRepository, 
                            EntityManagerInterface $em, MailerInterface $mailer,
                            AdresseRepository $adresseRepository,
                            LigneCommandeRepository $ligneCommandeRepository):Response
    {
        $commande = $commandeRepository->find($id);
        $tabLigneCommandes = $ligneCommandeRepository->findByCommande($commande);

        $user = $this->getUser();
        $adresseLivraison = $adresseRepository->getAdresseLivraison($user);
        
        if($commande->getStatus() ==  'en-livraison')
        {
            $commande->setStatus(Commande::LIVR);
            $em->flush();

            // l'admin envoie un email de notification de livraison au vendeur et à l'acheteur
            $emailReception = new TemplatedEmail();

            $emailReception->to( $commande->getBoutique()->getVendeur()->getEmail() )
            ->addTo($user->getEmail())
            ->from('maurice.henriet@yahoo.fr')
            ->subject(
                'La commande '.$commande->getId().' sur le marché virtuel - boutique '
                .$commande->getBoutique()->getNom().
                ' par l\'acheteur '.$user->getFirstName().' '.
                $user->getName().', a bien été réceptionnée')
            ->htmlTemplate('email/commande_reception.html.twig')
            ->context([
                'commande' => $commande,
                'lignes' => $tabLigneCommandes,
                'acheteur' => $user,
                'adresseLivraison' => $adresseLivraison,
                'boutique' => $commande->getBoutique()
            ]);

            $mailer->send($emailReception);

            $this->addFlash('success', 'Vous avez bien reçu votre commande'.$commande->getId().': '.$commande->getBoutique()->getNom().'. 
                Si vous le souhaitez vous pouvez partager votre avis sur le(s) produit(s).');
        }

        return $this->redirectToRoute('profile_commandes_show');
    }
}