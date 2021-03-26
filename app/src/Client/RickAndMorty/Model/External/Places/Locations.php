<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Model\External\Places;

use App\Client\RickAndMorty\Model\External\ExternalModelListInterface;

/**
 * Collection class for Location instances
 */
final class Locations implements ExternalModelListInterface
{
    /**
     * @var Location[]
     */
    private array $locations;

    /**
     * Locations constructor.
     * @param Location ...$locations
     */
    public function __construct(Location ...$locations)
    {
        $this->locations = $locations;
    }

    /**
     * Add Location to list.
     *
     * @param Location $location
     *
     * @return void
     */
    public function add(Location $location): void
    {
        $this->locations[] = $location;
    }

    /**
     * Get all location.
     *
     * @return Location[] The users
     */
    public function all(): array
    {
        return $this->locations;
    }

    /**
     * @return array
     */
    public function getIds(): array
    {
        return array_map(function($e) {
            return $e->getId();
        }, $this->locations);
    }

    /**
     * @return array
     */
    public function getAllResidents(): array
    {
        return array_map(function($e) {
            return $e->getResidents();
        }, $this->locations);
    }
}