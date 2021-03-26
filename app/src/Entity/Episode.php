<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EpisodeRepository::class)
 */
class Episode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $externalId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="date")
     */
    private ?DateTimeInterface $airDate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private ?string $episode;

    /**
     * @ORM\ManyToMany(targetEntity=Character::class, inversedBy="episodes")
     */
    private ArrayCollection $characters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExternalId(): ?int
    {
        return $this->externalId;
    }

    public function setExternalId(?int $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAirDate(): ?DateTimeInterface
    {
        return $this->airDate;
    }

    public function setAirDate(DateTimeInterface $airDate): self
    {
        $this->airDate = $airDate;

        return $this;
    }

    public function getEpisode(): ?string
    {
        return $this->episode;
    }

    public function setEpisode(string $episode): self
    {
        $this->episode = $episode;

        return $this;
    }

    /**
     * @return Collection|Character[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        $this->characters->removeElement($character);

        return $this;
    }
}
