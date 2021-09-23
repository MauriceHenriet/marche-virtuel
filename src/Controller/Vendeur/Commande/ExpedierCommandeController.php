<?php

namespace App\Controller\Vendeur\Commande;

use App\Entity\Commande;
use App\Repository\AdresseRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LigneCommandeRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExpedierCommandeController extends AbstractController
{
    /**
     * @Route("/vendeur/commande/expedier/{id}", name="vendeur_commande_expedier")
     */
    public function expedier(int $id, CommandeRepository $commandeRepository, 
                        EntityManagerInterface $em, MailerInterface $mailer,
                        AdresseRepository $adresseRepository,
                        LigneCommandeRepository $ligneCommandeRepository)
    {
        $commande = $commandeRepository->find($id);
        $tabLigneCommandes = $ligneCommandeRepository->findByCommande($commande);

        $adresseLivraison = $adresseRepository->getAdresseLivraison($commande->getUser());
  
        if($commande->getStatus() ==  'a-expedier')
        {
            $commande->setStatus(Commande::EN_LIV);
            $em->flush();

            // l'admin envoie un email de notification d'éexpedition à l'acheteur et au vendeur
            $emailExpedition = new TemplatedEmail();

            $emailExpedition->to( $commande->getBoutique()->getVendeur()->getEmail() )
            ->addTo($commande->getBoutique()->getVendeur()->getEmail())
            ->from('maurice.henriet@yahoo.fr')
            ->subject(
                'La commande '.$commande->getId().' sur le marché virtuel - boutique '
                .$commande->getBoutique()->getNom().
                ' par l\'acheteur '.$commande->getUser()->getFirstName().' '.
                $commande->getUser()->getName().', vient d\'être expédiée.')
            ->htmlTemplate('email/commande_expedition.html.twig')
            ->context([
                'commande' => $commande,
                'lignes' => $tabLigneCommandes,
                'acheteur' => $commande->getUser(),
                'adresseLivraison' => $adresseLivraison,
                'boutique' => $commande->getBoutique()
            ]);

            $mailer->send($emailExpedition);

            $this->addFlash('success', 'Vous avez bien expédié la commande'.$commande->getId().': '.$commande->getBoutique()->getNom().'. 
                Vous recevrez un email de confirmation de la bonne réception du colis auprès de l\'acheteur.');
        }

        return $this->redirectToRoute('vendeur_commandes_show');
    }

}