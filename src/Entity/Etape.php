<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EtapeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
#[ApiResource]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Designation = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'etape')]
    private Collection $Medias;

    /**
     * @var Collection<int, Option>
     */
    #[ORM\OneToMany(targetEntity: Option::class, mappedBy: 'etape')]
    private Collection $Options;

    public function __construct()
    {
        $this->Medias = new ArrayCollection();
        $this->Options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(string $Designation): static
    {
        $this->Designation = $Designation;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->Medias;
    }

    public function addMedia(Media $media): static
    {
        if (!$this->Medias->contains($media)) {
            $this->Medias->add($media);
            $media->setEtape($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): static
    {
        if ($this->Medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getEtape() === $this) {
                $media->setEtape(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Option>
     */
    public function getOptions(): Collection
    {
        return $this->Options;
    }

    public function addOption(Option $option): static
    {
        if (!$this->Options->contains($option)) {
            $this->Options->add($option);
            $option->setEtape($this);
        }

        return $this;
    }

    public function removeOption(Option $option): static
    {
        if ($this->Options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getEtape() === $this) {
                $option->setEtape(null);
            }
        }

        return $this;
    }
}
