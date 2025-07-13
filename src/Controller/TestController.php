<?php
namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/hello', methods: ['GET'])]
    public function hello(Connection $connection): JsonResponse
    {
        $results = ['tete'];

        return new JsonResponse($results);
    }
}
