<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Api\Cast;

use App\Client\RickAndMorty\Api\AbstractApi;
use App\Client\RickAndMorty\Api\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class that connects with the Characters API
 */
class CharacterApi extends AbstractApi
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $url;

    /**
     * CharacterApi constructor.
     * @param string $baseUrl
     */
    public function __construct(
        string $baseUrl
    ) {
        $this->client = new Client();

        $this->url = $baseUrl;
    }

    /**
     * @inheritDoc
     * @throws ApiException
     */
    public function one(int $id): array
    {
        try {
            $response = $this->client->get(
                $this->url."/character/$id"
            );

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            throw ApiException::buildWithError((array)$response);
        } catch (GuzzleException $e) {
            $this->logger->alert("The next error occurred while sending the request: ".$e->getMessage());
            return [];
        }
    }

    /**
     * @inheritDoc
     * @throws ApiException
     */
    public function all(): array
    {
        try {
            $response = $this->client->get(
                $this->url."/character"
            );

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            throw ApiException::buildWithError((array)$response);
        } catch (GuzzleException $e) {
            $this->logger->alert("The next error occurred while sending the request: ".$e->getMessage());
            return [];
        }
    }

    /**
     * @inheritDoc
     * @throws ApiException
     */
    public function filter(array $filter): array
    {
        try {
            $response = $this->client->get(
                $this->url."/character",
                [
                    'query' => $filter
                ]
            );

            if ($response->getStatusCode() == 200) {
                $results = json_decode($response->getBody()->getContents(), true);

                return $results["results"];
            }

            throw ApiException::buildWithError((array)$response);
        } catch (GuzzleException $e) {
            $this->logger->alert("The next error occurred while sending the request: ".$e->getMessage());
            return [];
        }
    }

    /**
     * @inheritDoc
     * @throws ApiException
     */
    public function multiple(array $ids): array
    {
        $queryString = implode(",", $ids);
        try {
            $response = $this->client->get(
                $this->url."/character/$queryString",
            );

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            throw ApiException::buildWithError((array)$response);
        } catch (GuzzleException $e) {
            $this->logger->alert("The next error occurred while sending the request: ".$e->getMessage());
            return [];
        }
    }
}