<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Factory\Places;

use App\Client\RickAndMorty\Factory\Exceptions\FactoryException;
use App\Client\RickAndMorty\Model\External\Places\Location;
use App\Client\RickAndMorty\Factory\FactoryInterface;
use App\Client\RickAndMorty\Model\External\Places\Locations;
use JMS\Serializer\Serializer;
use __\__;

/**
 * Builds instances of Location
 */
class LocationFactory implements FactoryInterface
{
    /**
     * @var Serializer
     */
    public Serializer $serializer;

    /**
     * LocationFactory constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param array $results
     * @return Locations|null
     * @throws FactoryException
     */
    public function createListFromArray(array $results): ?Locations
    {
        $resultCollection = [];
        foreach ($results as $result) {
            $resultCollection[] = $this->serializer->deserialize(
                json_encode($result),
                Location::class,
                'json'
            );
        }

        if (__::isEmpty($resultCollection)) {
            throw FactoryException::occurred([
                "results" => $results
            ]);
        }

        return new Locations(...$resultCollection);
    }

    /**
     * @inheritDoc
     */
    public function createFromArray(array $data): ?Location
    {
        return $this->serializer->deserialize(
            json_encode($data),
            Location::class,
            'json'
        );
    }
}