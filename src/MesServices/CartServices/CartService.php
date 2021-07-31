<?php

namespace App\MesServices\CartServices;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    protected $produitRepository;

    public function __construct(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $this->session = $session;
        $this->produitRepository = $produitRepository;
    }

    public function getFdp()
    {
        $panier = $this->getCart();

        if(empty($panier))
        {
            return 0;
        }
        
        $produitId = array_keys($panier)[0];
        $produit = $this->produitRepository->find($produitId);
        
        return $produit->getBoutique()->getFdp();
    }

    public function getTotal():int
    {

        $total=0;
        $cart = $this->getCart();

        $total += $this->getFdp();
        

        foreach ($cart as $id => $qty)
        {
            $produit = $this->produitRepository->find($id);

            if(!$produit)
            {
                continue;
            }

            $total += $produit->getPrix() * $qty;
        }

        return $total;
    }

    public function add(int $id)
    {
        // crée ou récupère le tableau cart[] dans la session
        $cart = $this->getCart();

        // si le produit n'est pas dans le cart 
        if(!array_key_exists($id, $cart))
        {
            // alors on crée la clé avec une quantité 0
            $cart[$id] = 0;
        }

        // on incrémente la quantité
        $cart[$id]++;
        
        //// pour vider le panier
        // $cart = $session->set('cart', []);

        $this->saveCart($cart);

    }

    public function decrement(int $id)
    {
        $cart = $this->getCart();

        if(!array_key_exists($id, $cart))
        {
            return;
        }

        if($cart[$id] === 1)
        {
            $this->remove($id);
            return;
        }
        
        $cart[$id]--;

        $this->saveCart($cart);
    }

    public function remove(int $id)
    {
        $cart = $this->getCart();

        unset($cart[$id]);

        $this->saveCart($cart);
    }

    public function show():array
    {
        $detailedCart = [];

        $cart = $this->getCart();

        foreach($cart as $id => $qty)
        {
            $produit = $this->produitRepository->find($id);

            if(!$produit)
            {
                continue;
            }

            $detailedCart[] = [
                'produit' => $produit, 
                'qte' => $qty
            ];

        }

        return $detailedCart;
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

    public function countArticles()
    {
        $cart = $this->getCart();
        $nbArticles = 0;

        foreach ($cart as $idArticle => $qty) 
        {
            $nbArticles += $qty;
        }

        return $nbArticles;
    }

}