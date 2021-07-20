<?php

namespace App\MesServices\ImageServices;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBag;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DeleteImageService
{
    protected $containerBag;

    public function __construct(ContainerBagInterface $containerBagInterface)
    {
        $this->containerBag = $containerBagInterface;
    }


    public function deleteImage(?string $imageUrl)
    {
        // Processus de direction
        if($imageUrl !== null)
        {
            $fileImageOriginal = $this->containerBag->get('app_images_directory') . '/..' . $imageUrl;
                
             if(file_exists($fileImageOriginal))
            {
                unlink($fileImageOriginal);
            }
        }       
    }
}