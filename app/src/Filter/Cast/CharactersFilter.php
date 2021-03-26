<?php
declare(strict_types=1);
namespace App\Filter\Cast;

use App\Filter\FilterInterface;
use App\Client\RickAndMorty\Model\External\Places\Location;
use App\Filter\Places\LocationsFilter;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @Serializer\ExclusionPolicy("all")
*/
class CharactersFilter implements FilterInterface
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Assert\Expression(
     *     "this.getLocation() != null or value != null",
     *     message="Either the location or the episode has to be set"
     * )
     * @var int|null
     */
    private ?int $episode = null;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("App\Filter\Places\LocationsFilter")
     * @Assert\Expression(
     *     "this.getEpisode() != null or value != null",
     *     message="Either the location or the episode has to be set"
     * )
     */
    private ?LocationsFilter $location = null;

    /**
     * @return Location|null
     */
    public function getLocation(): ?LocationsFilter
    {
        return $this->location;
    }

    /**
     * @param LocationsFilter|null $location
     */
    public function setLocation(?LocationsFilter $location): void
    {
        $this->location = $location;
    }

    /**
     * @return int|null
     */
    public function getEpisode(): ?int
    {
        return $this->episode;
    }

    /**
     * @param int|null $episode
     */
    public function setEpisode(?int $episode): void
    {
        $this->episode = $episode;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $filter = [];
        if ($this->episode)
            $filter["episode"] = $this->episode;

        if ($this->location)
            return $this->location->toArray();

        return $filter;
    }
}