<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Model\External\Episodes;

use App\Client\RickAndMorty\Model\External\ExternalModelListInterface;
use App\Client\RickAndMorty\Model\External\Places\Location;

final class Episodes implements ExternalModelListInterface
{
    /**
     * @var Location[]
     */
    private array $episodes;

    /**
     * Locations constructor.
     * @param Episode ...$episodes
     */
    public function __construct(Episode ...$episodes)
    {
        $this->episodes = $episodes;
    }

    /**
     * Add Location to list.
     *
     * @param Episode $episode
     * @return void
     */
    public function add(Episode $episode): void
    {
        $this->episodes[] = $episode;
    }

    /**
     * Get all location.
     *
     * @return Episode[] The users
     */
    public function all(): array
    {
        return $this->episodes;
    }

    /**
     * @return array
     */
    public function getIds(): array
    {
        return array_map(function($e) {
            return $e->getId();
        }, $this->episodes);
    }

    /**
     * @return array
     */
    public function getAllCharacters(): array
    {
        return array_map(function($e) {
            return $e->getCharacters();
        }, $this->episodes);
    }
}