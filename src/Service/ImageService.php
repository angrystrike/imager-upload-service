<?php

namespace App\Service;

use App\Repository\ImageRepository;
use App\Entity\Image; // Important to import

class ImageService
{
    public function __construct(
        private ImageRepository $imageRepository
    ) {}

    public function getAllImages(): array
    {
        return $this->imageRepository->findAll();
    }
}
