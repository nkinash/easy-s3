<?php

declare(strict_types=1);

namespace nka20\EasyS3;


use Aws\Result;
use Aws\S3\S3Client;

class EasyS3Service
{
    protected S3Client $client;

    /**
     * For easy s3 use you should
     * only give your credits to constructor
     * and region
     * @param string $key
     * @param string $secret
     * @param string $region
     * @param string $version
     * @param string $endpoint
     * @param array $config
     */
    public function __construct(
        string $key,
        string $secret,
        string $region,
        string $endpoint = '',
        string $version = 'latest',
        array $config = []
    )
    {
        $config['credentials'] = [
            'key' => $key,
            'secret' => $secret,
        ];

        $config['region'] = $region;
        $config['version'] = $version;

        if (!empty($endpoint)) {
            $config['endpoint'] = $endpoint;
            $config['http']['verify'] = false;
        }

        $this->client = new S3Client($config);
    }

    /**
     * @return Result
     */
    public function listBuckets(): Result
    {
        return $this->client->listBuckets();
    }

    /**
     * @param string $bucket
     * @return Result
     */
    public function listObjects(string $bucket): Result
    {
        return $this->client->listObjects([
            'Bucket' => $bucket
        ]);
    }

    /**
     * @param string $bucket
     * @param string $key
     * @param string $data
     * @return Result
     */
    public function putObject(string $bucket, string $key, string $data): Result
    {
        return $this->client->putObject([
            'Bucket' => $bucket,
            'Key' => $key,
            'Body' => $data,
        ]);
    }

    /**
     * @param string $bucket
     * @param string $key
     * @return string
     */
    public function getObject(string $bucket, string $key): string
    {
        $result = $this->client->getObject([
            'Bucket' => $bucket,
            'Key' => $key,

        ]);

        return $result['Body']->getContents();
    }

    /**
     * @param string $bucket
     * @param string $key
     * @return Result
     */
    public function deleteObject(string $bucket, string $key): Result
    {
        return $this->client->deleteObjects([
            'Bucket'  => $bucket,
            'Delete' => [
                'Objects' => [
                    [
                        'Key' => $key
                    ]
                ]
            ]
        ]);
    }


    /**
     * @param string $bucket
     * @param array $keys
     * @return Result
     */
    public function deleteObjects(string $bucket, array $keys): Result
    {
        return $this->client->deleteObjects([
            'Bucket'  => $bucket,
            'Delete' => [
                'Objects' => [
                    [
                        'Key' => $keys
                    ]
                ]
            ]
        ]);
    }

    /**
     * @param string $name
     * @param array $args
     * @return Result
     */
    public function createBucket(string $name, array $args = []): Result
    {
        $args['bucket'] = $name;
        return $this->client->createBucket($args);
    }

    /**
     * @param string $name
     * @param array $args
     * @return Result
     */
    public function deleteBucket(string $name, array $args = []): Result
    {
        $args['bucket'] = $name;
        return $this->client->createBucket($args);
    }

    /**
     * For advanced S3 Client use
     * @return S3Client
     */
    public function getClient(): S3Client
    {
        return $this->client;
    }

}
