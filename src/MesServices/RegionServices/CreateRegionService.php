<?php

namespace App\MesServices\RegionServices;

class CreateRegionService
{
    public function createRegion(Object $entity)
    {
        $dpt = substr($entity->getCodePostal(), 0, 2);

        if($dpt == '01' || $dpt == '03' || $dpt == '07' || 
            $dpt == '15' || $dpt == '26' || $dpt == '38' ||
            $dpt == '42' || $dpt == '43' || $dpt == '63' ||
            $dpt == '69' || $dpt == '73' || $dpt == '74' )
        {
            $entity->setRegion('Auvergne-Rhône-Alpes');
        }
        elseif($dpt == '21' || $dpt == '25' || $dpt == '39' || 
            $dpt == '58' || $dpt == '70' || $dpt == '71' ||
            $dpt == '89' || $dpt == '90' )
        {
            $entity->setRegion('Bourgogne-Franche-Comté');
        }
        elseif($dpt == '22' || $dpt == '29' || $dpt == '35' || 
                $dpt == '56' )
        {
            $entity->setRegion('Bretagne');
        }
        elseif($dpt == '18' || $dpt == '28' || $dpt == '36' || 
                $dpt == '37' || $dpt == '41' || $dpt == '45' )
        {
            $entity->setRegion('Centre-Val de Loire');
        }
        elseif($dpt == '20' )
        {
            $entity->setRegion('Corse');
        }
        elseif($dpt == '08' || $dpt == '10' || $dpt == '51' || 
            $dpt == '52' || $dpt == '54' || $dpt == '55' ||
            $dpt == '57' || $dpt == '67' || $dpt == '68' ||
            $dpt == '88')
        {
            $entity->setRegion('Grand Est');
        }
        elseif($dpt == '02' || $dpt == '59' || $dpt == '60' || 
            $dpt == '62' || $dpt == '80' )
        {
            $entity->setRegion('Hauts-de-France');
        }
        elseif($dpt == '75' || $dpt == '77' || $dpt == '78' || 
            $dpt == '91' || $dpt == '92' || $dpt == '93' ||
            $dpt == '94' || $dpt == '95' )
        {
            $entity->setRegion('Ile-de-France');
        }
        elseif($dpt == '14' || $dpt == '27' || $dpt == '50' || 
            $dpt == '61' || $dpt == '76' )
        {
            $entity->setRegion('Normandie');
        }
        elseif($dpt == '16' || $dpt == '17' || $dpt == '19' || 
            $dpt == '23' || $dpt == '24' || $dpt == '33' ||
            $dpt == '40' || $dpt == '47' || $dpt == '64' ||
            $dpt == '79' || $dpt == '86' || $dpt == '87' )
        {
            $entity->setRegion('Nouvelle-Aquitaine');
        }
        elseif($dpt == '09' || $dpt == '11' || $dpt == '12' || 
            $dpt == '30' || $dpt == '31' || $dpt == '32' ||
            $dpt == '34' || $dpt == '46' || $dpt == '48' ||
            $dpt == '65' || $dpt == '66' || $dpt == '81' ||
            $dpt == '82' )
        {
            $entity->setRegion('Occitanie');
        }
        elseif($dpt == '44' || $dpt == '49' || $dpt == '53' || 
            $dpt == '72' || $dpt == '85' )
        {
            $entity->setRegion('Pays de la Loire');
        }
        elseif($dpt == '04' || $dpt == '05' || $dpt == '06' || 
            $dpt == '13' || $dpt == '83' || $dpt == '84' )
        {
            $entity->setRegion('Provence-Alpes-Côte d\'Azur');
        }
        elseif($dpt == '97' || $dpt == '98' )
        {
            $entity->setRegion('DOM-TOM');
        }
  
    }
}