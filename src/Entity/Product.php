<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Price::class, mappedBy="product")
     */
    private $prices;

    /**
     * @ORM\OneToMany(targetEntity=Recomendation::class, mappedBy="product")
     */
    private $recomendations;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
        $this->recomendations = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Price>
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setProduct($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        if ($this->prices->removeElement($price)) {
            // set the owning side to null (unless already changed)
            if ($price->getProduct() === $this) {
                $price->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recomendation>
     */
    public function getRecomendations(): Collection
    {
        return $this->recomendations;
    }

    public function addRecomendation(Recomendation $recomendation): self
    {
        if (!$this->recomendations->contains($recomendation)) {
            $this->recomendations[] = $recomendation;
            $recomendation->setProduct($this);
        }

        return $this;
    }

    public function removeRecomendation(Recomendation $recomendation): self
    {
        if ($this->recomendations->removeElement($recomendation)) {
            // set the owning side to null (unless already changed)
            if ($recomendation->getProduct() === $this) {
                $recomendation->setProduct(null);
            }
        }

        return $this;
    }
}
