<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client extends User
{
    // /**
    //  * @ORM\Id
    //  * @ORM\GeneratedValue
    //  * @ORM\Column(type="integer")
    //  */
    // private $id;

    /**
     * @ORM\OneToMany(targetEntity=Price::class, mappedBy="client")
     */
    private $quotations;

    /**
     * @ORM\OneToMany(targetEntity=Recomendation::class, mappedBy="client")
     */
    private $recomendations;

    public function __construct()
    {
        $this->quotations = new ArrayCollection();
        $this->recomendations = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    /**
     * @return Collection<int, Price>
     */
    public function getQuotations(): Collection
    {
        return $this->quotations;
    }

    public function addQuotation(Price $quotation): self
    {
        if (!$this->quotations->contains($quotation)) {
            $this->quotations[] = $quotation;
            $quotation->setClient($this);
        }

        return $this;
    }

    public function removeQuotation(Price $quotation): self
    {
        if ($this->quotations->removeElement($quotation)) {
            // set the owning side to null (unless already changed)
            if ($quotation->getClient() === $this) {
                $quotation->setClient(null);
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
            $recomendation->setClient($this);
        }

        return $this;
    }

    public function removeRecomendation(Recomendation $recomendation): self
    {
        if ($this->recomendations->removeElement($recomendation)) {
            // set the owning side to null (unless already changed)
            if ($recomendation->getClient() === $this) {
                $recomendation->setClient(null);
            }
        }

        return $this;
    }
}
