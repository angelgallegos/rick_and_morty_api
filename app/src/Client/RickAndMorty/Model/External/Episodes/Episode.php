<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Model\External\Episodes;

use App\Client\RickAndMorty\Model\External\ExternalModelInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class Episode implements ExternalModelInterface
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private int $id;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private string $name;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private string $air_date;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private string $episode;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("array")
     */
    private array $characters;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private string $url;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private string $created;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAirDate(): string
    {
        return $this->air_date;
    }

    /**
     * @param string $air_date
     */
    public function setAirDate(string $air_date): void
    {
        $this->air_date = $air_date;
    }

    /**
     * @return string
     */
    public function getEpisode(): string
    {
        return $this->episode;
    }

    /**
     * @param string $episode
     */
    public function setEpisode(string $episode): void
    {
        $this->episode = $episode;
    }

    /**
     * @return array
     */
    public function getCharacters(): array
    {
        return $this->characters;
    }

    /**
     * @param array $characters
     */
    public function setCharacters(array $characters): void
    {
        $this->characters = $characters;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @param string $created
     */
    public function setCreated(string $created): void
    {
        $this->created = $created;
    }
}