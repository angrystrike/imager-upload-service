<?php

namespace App\MessageBus\Handlers;

use App\MessageBus\Messages\Message;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MessageHandler
{
    public function __construct(private Connection $connection) {}

    public function __invoke(Message $message): void
    {
        $results = $this->connection->fetchAllAssociative('SELECT * FROM test');
        dump($results);
    }
}
