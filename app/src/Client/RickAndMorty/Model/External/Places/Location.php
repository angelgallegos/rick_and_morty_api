<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Model\External\Places;

use App\Client\RickAndMorty\Model\External\ExternalModelInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class Location implements ExternalModelInterface
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private ?int $id = null;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $name;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $type = null;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private ?string $dimension = null;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("array")
     */
    private ?array $residents = null;

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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDimension(): ?string
    {
        return $this->dimension;
    }

    /**
     * @param string|null $dimension
     * @return $this
     */
    public function setDimension(?string $dimension): self
    {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getResidents(): ?array
    {
        return $this->residents;
    }

    /**
     * @param array|null $residents
     */
    public function setResidents(?array $residents): void
    {
        $this->residents = $residents;
    }
}