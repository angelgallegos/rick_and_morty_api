<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Request\Places;

use App\Client\RickAndMorty\Api\Exceptions\ApiException;
use App\Client\RickAndMorty\Api\Places\LocationApi;
use App\Client\RickAndMorty\Factory\Exceptions\FactoryException;
use App\Client\RickAndMorty\Factory\Places\LocationFactory;
use App\Client\RickAndMorty\Model\External\Places\Location;
use App\Client\RickAndMorty\Model\External\Places\Locations;
use App\Client\RickAndMorty\Request\AbstractRequest;
use App\Client\RickAndMorty\Request\Exceptions\NoResponseException;
use App\Client\RickAndMorty\Request\Exceptions\RequestException;
use App\Filter\FilterInterface;
use __\__;

class LocationRequest extends AbstractRequest
{
    /**
     * @var LocationApi
     */
    private LocationApi $locationClient;

    /**
     * @var LocationFactory
     */
    private LocationFactory $locationFactory;

    /**
     * LocationRequest constructor.
     * @param LocationApi $locationApi
     * @param LocationFactory $locationFactory
     */
    public function __construct(
        LocationApi $locationApi,
        LocationFactory $locationFactory
    ) {
        $this->locationClient = $locationApi;
        $this->locationFactory = $locationFactory;
    }

    /**
     * @inheritDoc
     * @throws RequestException
     */
    public function one(int $id): ?Location
    {
        try {
            $response = $this->locationClient->one($id);
        } catch (ApiException $e) {
            $context = [
                "resource" => Location::class,
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

        return $this->locationFactory->createFromArray($response);
    }

    /**
     * @inheritDoc
     * @throws FactoryException
     * @throws NoResponseException
     * @throws RequestException
     */
    public function filter(FilterInterface $filter): ?Locations
    {
        try {
            $response = $this->locationClient->filter($filter->toArray());
        } catch (ApiException $e) {
            $context = [
                "resource" => Location::class,
                "filter" => $filter->toArray()
            ];
            $this->logger->alert(
                "The API threw the following exception: ".$e->getMessage(),
                array_merge(
                    $e->getContext(),
                    $context
                )
            );
            throw RequestException::occurred($e->getContext());
        }

        if (__::isEmpty($response)) {
            throw NoResponseException::occurred([
                "filter" => $filter->toArray()
            ]);
        }

        return $this->locationFactory->createListFromArray($response);
    }

    /**
     * @inheritDoc
     * @throws FactoryException
     * @throws RequestException
     */
    public function multiple(array $ids): ?Locations
    {
        try {
            $response = $this->locationClient->multiple($ids);
        } catch (ApiException $e) {
            $context = [
                "resource" => Location::class,
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

        return $this->locationFactory->createListFromArray($response);
    }
}