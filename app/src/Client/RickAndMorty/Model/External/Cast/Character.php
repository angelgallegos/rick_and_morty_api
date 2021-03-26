<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Model\External\Cast;

use App\Client\RickAndMorty\Model\External\ExternalModelInterface;
use App\Client\RickAndMorty\Model\External\Places\Location;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class Character implements ExternalModelInterface
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private ?int $id;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $name;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $status;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $species;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $type;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $gender;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $image;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("App\Client\RickAndMorty\Model\External\Places\Location")
     */
    private ?Location $origin;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("App\Client\RickAndMorty\Model\External\Places\Location")
     */
    private ?Location $location;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecies(): ?string
    {
        return $this->species;
    }

    /**
     * @param string $species
     * @return $this
     */
    public function setSpecies(string $species): self
    {
        $this->species = $species;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return $this
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return $this
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return $this
     */
    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Location|null
     */
    public function getOrigin(): ?Location
    {
        return $this->origin;
    }

    /**
     * @param Location|null $origin
     * @return $this
     */
    public function setOrigin(?Location $origin): self
    {
        $this->origin = $origin;

        return $this;
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
     * @return $this
     */
    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }
}