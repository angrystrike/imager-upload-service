<?php

namespace App\MessageBus\Messages;

class File
{
    public string $file_name;
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }
}
