<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'cat', targetEntity: Pro::class)]
    private Collection $pros;

    public function __construct()
    {
        $this->pros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Pro>
     */
    public function getPros(): Collection
    {
        return $this->pros;
    }

    public function addPro(Pro $pro): static
    {
        if (!$this->pros->contains($pro)) {
            $this->pros->add($pro);
            $pro->setCat($this);
        }

        return $this;
    }

    public function removePro(Pro $pro): static
    {
        if ($this->pros->removeElement($pro)) {
            // set the owning side to null (unless already changed)
            if ($pro->getCat() === $this) {
                $pro->setCat(null);
            }
        }

        return $this;
    }
    /*
    public function __toString()
    {
        return $this->name;
    }
        */
}
