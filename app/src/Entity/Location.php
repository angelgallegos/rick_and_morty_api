<?php

namespace App\Entity;

use App\Model\External\ExternalModelInterface;
use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 * @Serializer\ExclusionPolicy("all")
 */
class Location implements ExternalModelInterface
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
    private ?int $externalId = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     */
    private ?string $type = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"response", "request"})
     */
    private ?string $dimension = null;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"request"})
     * @var string|null
     */
    private ?string $url = null;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="location")
     */
    private $residents;

    public function __construct()
    {
        $this->residents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExternalId(): ?int
    {
        if ($this->getId() !== null)
            return $this->externalId;


        return (int)substr($this->getUrl(), strrpos($this->getUrl(), '/') + 1);
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDimension(): ?string
    {
        return $this->dimension;
    }

    public function setDimension(?string $dimension): self
    {
        $this->dimension = $dimension;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Character[]
     */
    public function getResidents(): Collection
    {
        return $this->residents;
    }

    public function addResident(Character $resident): self
    {
        if (!$this->residents->contains($resident)) {
            $this->residents[] = $resident;
            $resident->setLocation($this);
        }

        return $this;
    }

    public function removeResident(Character $resident): self
    {
        if ($this->residents->removeElement($resident)) {
            // set the owning side to null (unless already changed)
            if ($resident->getLocation() === $this) {
                $resident->setLocation(null);
            }
        }

        return $this;
    }
}
