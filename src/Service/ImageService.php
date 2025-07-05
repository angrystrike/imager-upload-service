<?php

namespace App\Service;

use App\Repository\ImageRepository;
use App\Entity\Image;


class ImageService
{
    public function __construct(
        private ImageRepository $imageRepository,
    ) {}

    public function getAllImages(): array
    {
        return $this->imageRepository->findAll();
    }

    public function save(array $data)
    {
        $image = new Image();
        $image->setFilename($data['file_name']);
        $image->setPath($data['path']);

        return $this->imageRepository->save($image);
    }
}
