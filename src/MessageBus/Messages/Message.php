<?php

namespace App\MessageBus\Messages;

class Message
{
    public string $content;
    public function __construct(string $content)
    {
        $this->content = $content;
    }
}
