<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Request\Episodes;

use App\Client\RickAndMorty\Api\Episodes\EpisodeApi;
use App\Client\RickAndMorty\Api\Exceptions\ApiException;
use App\Client\RickAndMorty\Factory\Episodes\EpisodeFactory;
use App\Client\RickAndMorty\Model\External\Cast\Character;
use App\Client\RickAndMorty\Model\External\Cast\Characters;
use App\Client\RickAndMorty\Model\External\Episodes\Episode;
use App\Client\RickAndMorty\Model\External\Episodes\Episodes;
use App\Client\RickAndMorty\Request\AbstractRequest;
use App\Client\RickAndMorty\Request\Exceptions\RequestException;
use App\Filter\FilterInterface;

class EpisodeRequest extends AbstractRequest
{
    /**
     * @var EpisodeApi
     */
    private EpisodeApi $episodeClient;

    /**
     * @var EpisodeFactory
     */
    private EpisodeFactory $episodeFactory;

    /**
     * LocationRequest constructor.
     * @param EpisodeApi $episodeApi
     * @param EpisodeFactory $episodeFactory
     */
    public function __construct(
        EpisodeApi $episodeApi,
        EpisodeFactory $episodeFactory
    ) {
        $this->episodeClient = $episodeApi;
        $this->episodeFactory = $episodeFactory;
    }

    /**
     * @param int $id
     * @return Episode|null
     * @throws RequestException
     */
    public function one(int $id): ?Episode
    {
        try {
            $response = $this->episodeClient->one($id);
        } catch (ApiException $e) {
            $context = [
                "resource" => Episode::class,
                "id" => $id
            ];
            $this->logger->alert(
                "The API threw the following exception: ".$e->getMessage(),
                array_merge(
                    $e->getContext(),
                    $context
                )
            );
            throw RequestException::occurred($context);
        }

        return $this->episodeFactory->createFromArray($response);
    }

    /**
     * @param FilterInterface $filter
     * @return Characters|null
     * @throws RequestException
     */
    public function filter(FilterInterface $filter): ?Episodes
    {
        try {
            $response = $this->episodeClient->filter($filter->toArray());
        } catch (ApiException $e) {
            $context = [
                "resource" => Character::class,
                "filter" => $filter->toArray()
            ];
            $this->logger->alert(
                "The API threw the following exception: ".$e->getMessage(),
                array_merge(
                    $e->getContext(),
                    $context
                )
            );
            throw RequestException::occurred($context);
        }

        return $this->episodeFactory->createListFromArray($response);
    }

    /**
     * @param array $ids
     * @return Episodes|null
     * @throws RequestException
     */
    public function multiple(array $ids): ?Episodes
    {
        try {
            $response = $this->episodeClient->multiple($ids);
        } catch (ApiException $e) {
            $context = [
                "resource" => Episode::class,
                "ids" => $ids
            ];
            $this->logger->alert(
                "The API threw the following exception: ".$e->getMessage(),
                array_merge(
                    $e->getContext(),
                    $context
                )
            );
            throw RequestException::occurred($context);
        }

        return $this->episodeFactory->createListFromArray($response);
    }
}