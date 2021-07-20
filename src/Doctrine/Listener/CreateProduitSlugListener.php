<?php

namespace App\Doctrine\Listener;

use App\Entity\Produit;
use Symfony\Component\String\Slugger\SluggerInterface;

class CreateProduitSlugListener
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Produit $entity)
    {
        if(empty($entity->getSlug()))
        {
            $entity->setSlug(strtolower(
                $this->slugger->slug($entity->getNom())
            ));
        }
    }

}