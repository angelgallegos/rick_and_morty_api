<?php
declare(strict_types=1);
namespace App\Service\Episodes;

use App\Client\RickAndMorty\Factory\Exceptions\FactoryException;
use App\Client\RickAndMorty\Model\External\Episodes\Episode;
use App\Client\RickAndMorty\Model\External\Places\Location;
use App\Client\RickAndMorty\Model\External\Places\Locations;
use App\Client\RickAndMorty\Request\Episodes\EpisodeRequest;
use App\Client\RickAndMorty\Request\Exceptions\NoResponseException;
use App\Client\RickAndMorty\Request\Exceptions\RequestException;
use App\Client\RickAndMorty\Request\Places\LocationRequest;
use App\Filter\Places\LocationsFilter;
use App\Service\AbstractService;

class EpisodeService extends AbstractService
{
    /**
     * @var EpisodeRequest
     */
    private EpisodeRequest $episodeRequest;

    public function __construct(
        EpisodeRequest $episodeRequest
    ) {
        $this->episodeRequest = $episodeRequest;
    }

    /**
     * @param LocationsFilter $locationFilter
     * @return Locations|null
     * @throws FactoryException
     * @throws RequestException
     */
    public function filter(LocationsFilter $locationFilter): ?Locations
    {
        try {
            $locations = null;
            if (isset($locationFilter->toArray()["location"])) {
                $location = $this->locationRequest->one($locationFilter->toArray()["location"]);
                $locations = new Locations($location);
            } else {
                $locations = $this->locationRequest->filter($locationFilter);
            }

            return $locations;
        } catch (FactoryException  | RequestException $e) {
            throw $e;
        } catch (NoResponseException $e) {
            $this->logger->notice(
                "The filter returned no results with error: ". $e->getMessage(),
                $e->getContext()
            );
            return null;
        }
    }

    /**
     * @param int $id
     * @return Episode|null
     * @throws RequestException
     */
    public function one(int $id): ?Episode
    {
        try {
            return $this->episodeRequest->one($id);
        } catch (RequestException $e) {
            throw $e;
        } catch (NoResponseException $e) {
            $this->logger->notice(
                "The filter returned no results with error: ". $e->getMessage(),
                $e->getContext()
            );
            return null;
        }
    }
}