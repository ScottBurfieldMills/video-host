<?php

namespace App;

use Aws\S3\S3Client;

class PresignedUrlGenerator
{
    /**
     * @var S3Client
     */
    private $s3Client;

    public function __construct(S3Client $s3Client)
    {
        $this->s3Client = $s3Client;
    }

    public function get()
    {
        // store information related to uploading file
        // create aws presigned url
        // return it to user

        $options = [
            'Bucket' => env('AWS_BUCKET'),
            'Key' => \Str::random(32),
            'ACL' => 'public-read'
        ];

        $cmd = $this->s3Client->getCommand('PutObject', $options);

        $request = $this->s3Client->createPresignedRequest($cmd, '+60 minutes');
        $result = $request->getUri();

        return (string)$result;
    }
}
