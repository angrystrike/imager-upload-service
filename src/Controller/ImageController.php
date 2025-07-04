<?php

namespace App\Controller;

use App\MessageBus\Messages\Message;
use App\Repository\ImageRepository;
use App\Service\ImageService;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ImageController extends AbstractController
{
    public function __construct(
        private ImageService $imageService,
        private SerializerInterface $serializer
    ) {}

    #[Route('/images', methods: ['GET'])]
    public function images(): JsonResponse
    {
        $images = $this->imageService->getAllImages();
        $images = $this->serializer->serialize(
            $images,
            'json',
            ['groups' => 'image:read']
        );

        return new JsonResponse($images, JsonResponse::HTTP_OK, [], true);
    }

//    #[Route('/images', methods: ['GET'])]
//    public function images(): JsonResponse
//    {
//        $images = $this->imageService->getAllImages();
//        $images = $this->serializer->serialize(
//            $images,
//            'json',
//            ['groups' => 'image:read']
//        );
//
//        return new JsonResponse($images, JsonResponse::HTTP_OK, [], true);
//    }
}
