<?php

namespace App\Controller;

use App\Service\ImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;


class ImageController extends AbstractController
{
    public function __construct(
        private ImageService $imageService,
        private SerializerInterface $serializer
    ) {}

    #[Route('/images', methods: ['GET'])]
    public function images(CacheInterface $cache): JsonResponse
    {
        $cacheKey = 'all_images_json';

        $images = $cache->get($cacheKey, function (ItemInterface $item) {
            $item->expiresAfter(3600);

            $images = $this->imageService->getAllImages();
            return $this->serializer->serialize(
                $images,
                'json',
                ['groups' => 'image:read']
            );
        });

        return new JsonResponse($images, JsonResponse::HTTP_OK, [], true);
    }
}
