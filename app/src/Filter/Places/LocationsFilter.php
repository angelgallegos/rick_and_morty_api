<?php
declare(strict_types=1);
namespace App\Filter\Places;

use App\Filter\FilterInterface;
use App\Client\RickAndMorty\Model\External\Places\Location;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class LocationsFilter implements FilterInterface
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Assert\Expression(
     *     "this.getLocation() != null or value != null",
     *     message="Either the location or the dimension has to be set"
     * )
     * @var string|null
     */
    private ?string $dimension = null;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("App\Client\RickAndMorty\Model\External\Places\Location")
     * @Assert\Expression(
     *     "this.getDimension() != null or value != null",
     *     message="Either the location or the dimension has to be set"
     * )
     */
    private ?Location $location = null;

    /**
     * @return string|null
     */
    public function getDimension(): ?string
    {
        return $this->dimension;
    }

    /**
     * @param string|null $dimension
     */
    public function setDimension(?string $dimension): void
    {
        $this->dimension = $dimension;
    }

    /**
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param Location|null $location
     */
    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }

    public function toArray(): array
    {
        $filter = [];
        if ($this->dimension)
            $filter["dimension"] = $this->dimension;

        if ($this->location) {
            if ($this->location->getId()) {
                $filter = [];
                $filter["location"] = $this->location->getId();
            } else
                $filter["name"] = $this->location->getName();
        }

        return $filter;
    }
}