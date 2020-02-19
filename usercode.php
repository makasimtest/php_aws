<?php

use Aws\S3\S3Client;

require_once __DIR__.'/vendor/autoload.php';

function handle($data) {
    $s3 = createS3($data['s3_key'], $data['s3_secret']);

    $data['result'] = $s3->putObject([
        'Content-Type'      => 'text/plain',
        'Bucket'            => 'gitcalltest',
        'Key'               => time().'.json',
        'Body'              => json_encode($data['content']),
        'ACL'               => 'public-read',
    ]);

    return $data;
}

function createS3(string $key, string $secret): S3Client {
    return new S3Client([
        'version' => 'latest',
        'region' => 'ams3',
        'endpoint' => 'https://fra1.digitaloceanspaces.com',
        'credentials' => [
            'key'    => $key,
            'secret' => $secret,
        ],
        'debug' => true
    ]);
}