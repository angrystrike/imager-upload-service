<?php

namespace App\MessageBus\Handlers;

use App\MessageBus\Messages\File;
use Aws\S3\S3Client;
use Pusher\Pusher;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FileHandler
{
    private Pusher $pusher;
    private S3Client $s3_client;
    private string $s3_bucket_name;

    public function __construct(Pusher $pusher, S3Client $s3_client)
    {
        $this->pusher = $pusher;
        $this->s3_client = $s3_client;
        $this->s3_bucket_name = $_ENV['AWS_S3_BUCKET_NAME'];
    }

    public function __invoke(File $file): void
    {
        $this->pusher->trigger('file-upload-info', 'file-received-by-upload-service', [
            'text' => 'upload-service BE: File received',
        ]);
        $full_path = '/var/www/shared-data/' . $file->file_name;
        $file_content = file_get_contents($full_path);

        $this->s3_client->putObject([
            'Bucket' => $this->s3_bucket_name,
            'Key'    => $file->file_name,
            'Body'   => $file_content,
            'ContentType' => mime_content_type($full_path)
        ]);

        $s3_file_name = $this->s3_client->getObjectUrl($this->s3_bucket_name, $file->file_name);
        $this->pusher->trigger('file-upload-info', 'file-uploaded-by-upload-service', [
            'text' => 'upload-service BE: File uploaded to S3. File name: ' . $s3_file_name
        ]);
    }
}
