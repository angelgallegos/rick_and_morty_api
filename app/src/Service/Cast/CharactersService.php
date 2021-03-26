<?php
declare(strict_types=1);
namespace App\Service\Cast;

use App\Client\RickAndMorty\Factory\Exceptions\FactoryException;
use App\Filter\Cast\CharactersFilter;
use App\Client\RickAndMorty\Model\External\Cast\Characters;
use App\Client\RickAndMorty\Request\Cast\CharacterRequest;
use App\Client\RickAndMorty\Request\Exceptions\RequestException;
use App\Service\AbstractService;
use App\Service\Episodes\EpisodeService;
use App\Service\Places\LocationService;
use __\__;

/**
 * Business logic methods for the Characters resource
 */
class CharactersService extends AbstractService
{
    /**
     * @var CharacterRequest
     */
    private CharacterRequest $characterRequest;

    /**
     * @var LocationService
     */
    private LocationService $locationService;

    /**
     * @var EpisodeService
     */
    private EpisodeService $episodeService;

    /**
     * CharactersService constructor.
     * @param CharacterRequest $characterRequest
     * @param LocationService $locationService
     * @param EpisodeService $episodeService
     */
    public function __construct(
        CharacterRequest $characterRequest,
        LocationService $locationService,
        EpisodeService $episodeService
    ) {
        $this->locationService = $locationService;
        $this->characterRequest = $characterRequest;
        $this->episodeService = $episodeService;
    }

    /**
     * Retrieve a collection object Characters
     * comprised of a list of Characters
     * and filtered based on the filter object provided
     *
     * @param CharactersFilter $charactersFilter
     * @return Characters|null
     * @throws RequestException
     */
    public function lists(CharactersFilter $charactersFilter): ?Characters
    {
        $filterObjects = null;
        try {
            if ($charactersFilter->getEpisode()) {
                $filterObjects = $this->episodeService->one($charactersFilter->getEpisode());
            } else {
                $filterObjects = $this->locationService->filter($charactersFilter->getLocation());
            }
        } catch (FactoryException | RequestException $e) {
            $this->logger->alert(
                "The filter failed due to the next exception: ". $e->getMessage(),
                $e->getContext()
            );
            return null;
        }

        if (!$filterObjects) {
            return null;
        }

        if ($charactersFilter->getEpisode()) {
            $charactersIds = __::flatten($filterObjects->getCharacters());
        } else {
            $charactersIds = __::flatten($filterObjects->getAllResidents());
        }
        $charactersIds = array_map(function ($id) {
            return (int)substr($id, strrpos($id, '/') + 1);
        }, $charactersIds);

        return $this->characterRequest->multiple($charactersIds);
    }
}