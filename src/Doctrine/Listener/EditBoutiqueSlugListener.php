<?php

namespace App\Doctrine\Listener;

use App\Entity\Boutique;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditBoutiqueSlugListener
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function preUpdate(Boutique $entity)
    {
        $entity->setSlug(strtolower($this->slugger->slug($entity->getNom())));
    }
}