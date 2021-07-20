<?php

namespace App\Doctrine\Listener;

use App\Entity\Boutique;
use Symfony\Component\String\Slugger\SluggerInterface;

class CreateBoutiqueSlugListener
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Boutique $entity)
    {
        if( empty($entity->getSlug()) )
        {
            $entity->setSlug(strtolower($this->slugger->slug($entity->getNom())));
        }
    }

}