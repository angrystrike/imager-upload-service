<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    #[Route('/hello', methods: ['GET'])]
    public function hello(): Response
    {
        return new Response('Hello from Upload Service!');
    }
}
