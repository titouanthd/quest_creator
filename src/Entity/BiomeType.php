<?php

namespace App\Entity;

use App\Repository\BiomeTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BiomeTypeRepository::class)]
class BiomeType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'biome_type', targetEntity: Biome::class)]
    private Collection $biomes;

    public function __construct()
    {
        $this->biomes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Biome>
     */
    public function getBiomes(): Collection
    {
        return $this->biomes;
    }

    public function addBiome(Biome $biome): self
    {
        if (!$this->biomes->contains($biome)) {
            $this->biomes->add($biome);
            $biome->setBiomeType($this);
        }

        return $this;
    }

    public function removeBiome(Biome $biome): self
    {
        if ($this->biomes->removeElement($biome)) {
            // set the owning side to null (unless already changed)
            if ($biome->getBiomeType() === $this) {
                $biome->setBiomeType(null);
            }
        }

        return $this;
    }
}
