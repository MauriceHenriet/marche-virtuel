<?php

namespace App\MesServices\ImageServices;

use App\MesServices\ImageServices\DeleteImageService;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class SaveImageService //extends AbstractController
{
    private $containerBagInterface;
    private $deleteImageService;

    public function __construct(ContainerBagInterface $containerBagInterface,
                                DeleteImageService $deleteImageService)
    {
        $this->containerBagInterface = $containerBagInterface;
        $this->deleteImageService = $deleteImageService;
    }

    public function saveImage(?object $file, object $entity, ?string $imageOriginal = null)
    {
        if($file !== null)
        {
            $fileName = md5(uniqid()) . '.' .$file->guessExtension();

            $file->move( $this->containerBagInterface->get('app_images_directory'),$fileName);

            $entity->setImageUrl('/uploads/'. $fileName);

            if($imageOriginal !== null)
            {
                $this->deleteImageService->deleteImage($imageOriginal);
            }
            
        }
    }

}