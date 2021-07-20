<?php

namespace App\Doctrine\Listener;

use App\Entity\Produit;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditProduitSlugListener
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function preUpdate(Produit $entity)
    {
        $entity->setSlug(strtolower($this->slugger->slug($entity->getNom())));
    }
}