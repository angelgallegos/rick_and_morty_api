<?php
declare(strict_types=1);
namespace App\Service\Places;

use App\Client\RickAndMorty\Factory\Exceptions\FactoryException;
use App\Filter\Places\LocationsFilter;
use App\Client\RickAndMorty\Model\External\Places\Locations;
use App\Client\RickAndMorty\Request\Exceptions\NoResponseException;
use App\Client\RickAndMorty\Request\Exceptions\RequestException;
use App\Client\RickAndMorty\Request\Places\LocationRequest;
use App\Service\AbstractService;
use __\__;

/**
 * Business logic methods for the Location resource
 */
class LocationService extends AbstractService
{
    /**
     * @var LocationRequest
     */
    private LocationRequest $locationRequest;

    public function __construct(
        LocationRequest $locationRequest
    ) {
        $this->locationRequest = $locationRequest;
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
}