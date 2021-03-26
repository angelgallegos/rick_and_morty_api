<?php

namespace App\Entity;

use App\Model\External\ExternalModelInterface;
use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Character implements ExternalModelInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Serializer\Groups({"response"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("id")
     */
    private ?int $externalId;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     * @var string|null
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     */
    private ?string $status;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     */
    private ?string $species;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     */
    private ?string $type;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     */
    private ?string $gender;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     */
    private ?string $image;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="natives")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose()
     * @Serializer\Type("App\Entity\Location")
     * @Serializer\Groups({"response", "request"})

     */
    private ?Location $origin;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="residents")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose()
     * @Serializer\Type("App\Entity\Location")
     * @Serializer\Groups({"response", "request"})

     */
    private ?Location $location;

    /**
     * @ORM\ManyToMany(targetEntity=Episode::class, mappedBy="characters")
     */
    private ArrayCollection $episodes;

    public function __construct()
    {
        $this->episodes = new ArrayCollection();
    }

    /**
     * @return int|null
     */
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getOrigin(): ?Location
    {
        return $this->origin;
    }

    public function setOrigin(?Location $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|Episode[]
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): self
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes[] = $episode;
            $episode->addCharacter($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): self
    {
        if ($this->episodes->removeElement($episode)) {
            $episode->removeCharacter($this);
        }

        return $this;
    }
}
