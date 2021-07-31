<?php

namespace App\MesServices\AdresseServices;

use App\Entity\Adresse;
use App\Repository\AdresseRepository;

class AdresseLivraisonService
{
    public function setAdresseLivraison(AdresseRepository $adresseRepository, Adresse $adresseLivraison)
    {
        $adresseLivraisonExists = $adresseRepository->getAdresseLivraison($adresseLivraison->getUser());

        if($adresseLivraisonExists)
        {
            $adresseLivraisonExists->setLivraison(false);
        }
     
        $adresseLivraison->setLivraison(true);

    }

}