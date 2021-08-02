<?php

namespace App\MesServices\CartServices;

use App\Repository\BoutiqueRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    protected $produitRepository;
    protected $boutiqueRepository;

    public function __construct(SessionInterface $session,
                        BoutiqueRepository $boutiqueRepository,
                        ProduitRepository $produitRepository)
    {
        $this->session = $session;
        $this->produitRepository = $produitRepository;
        $this->boutiqueRepository = $boutiqueRepository;
    }

    public function getFdp(int $boutiqueId)
    {        
        return $this->boutiqueRepository->find($boutiqueId)->getFdp();
    }

    public function add(int $id, int $boutiqueId)
    {
        $cart = $this->getCart();
        
        // si la boutique n'est pas dans le panier
        if ( !array_key_exists($boutiqueId, $cart) )
        {
            // alors on crée la clé boutique avec un tableau dont l'index 0 contient les fdp
            $cart[$boutiqueId][0] = $this->getFdp($boutiqueId);
        }

        // si le produit n'existe pas dans la boutique du panier
        if( !array_key_exists($id, $cart[$boutiqueId]) )
        {
            // alors on le rajoute dans le panier
            $cart[$boutiqueId][$id] = 0;
        }

        // on incrémente la quantité
        $cart[$boutiqueId][$id]++;

        $this->saveCart($cart);
    }

    public function decrement(int $id, int $boutiqueId)
    {
        $cart = $this->getCart();

        if (!array_key_exists($boutiqueId, $cart) || !array_key_exists($id, $cart[$boutiqueId]) )
        {
            return;
        }

        if($cart[$boutiqueId][$id] === 1)
        {
            $this->remove($id, $boutiqueId);
            return;
        }
        
        $cart[$boutiqueId][$id]--;

        $this->saveCart($cart);
    }

    public function remove(int $id, int $boutiqueId)
    {
        $cart = $this->getCart();

        unset($cart[$boutiqueId][$id]);

        if( count($cart[$boutiqueId]) == 1 )
        {
            unset($cart[$boutiqueId]);
        }

        $this->saveCart($cart);
    }

    public function removePanierBoutique(int $boutiqueId)
    {
        $cart = $this->getCart();

        unset($cart[$boutiqueId]);

        $this->saveCart($cart);
    }

    public function show():array
    {
        $detailedCart = [];
        $cart = $this->getCart();

        foreach($cart as $boutiqueId => $tab)
        {
            $detailedCart[$boutiqueId]['total'] = 0;
            $detailedCart[$boutiqueId]['produits'] = [];

            foreach ($tab as $id => $nb)
            {
                if($id == 0)
                {
                    $detailedCart[$boutiqueId]['fdp'] = $nb;
                    $detailedCart[$boutiqueId]['total'] += $nb;
                }
                else
                {
                    $produit = $this->produitRepository->find($id);

                    if(!$produit)  continue;

                    $detailedCart[$boutiqueId]['total'] += $produit->getPrix() * $nb;
                    $detailedCart[$boutiqueId]['produits'][] = [
                        'produit' => $produit, 
                        'qte' => $nb
                    ];
                }
            }
        }
        return $detailedCart;
    }

    public function countArticles()
    {
        $cart = $this->getCart();
        $nbArticles = 0;

        foreach($cart as $boutiqueId => $tab)
        {
            foreach($tab as $idArticle => $qty) 
            {
                if($idArticle != 0)
                {
                    $nbArticles += $qty;
                }
                
            }
        }

        return $nbArticles;
    }    

    public function getCart()
    {
        return $this->session->get('cart', []);
    }

    public function saveCart($cart)
    {
        $this->session->set('cart', $cart);
    }

    public function empty()
    {
        $cart = $this->getCart();

        $this->saveCart([]);
    }

}