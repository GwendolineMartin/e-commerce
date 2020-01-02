<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PurchaseRepository")
 */
class Purchase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sku", inversedBy="Purchases")
     */
    private $Sku;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Purchase")
     */
    private $user;

    public function __construct()
    {
        $this->Sku = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Sku[]
     */
    public function getSku(): Collection
    {
        return $this->Sku;
    }

    public function addSku(Sku $sku): self
    {
        if (!$this->Sku->contains($sku)) {
            $this->Sku[] = $sku;
        }

        return $this;
    }

    public function removeSku(Sku $sku): self
    {
        if ($this->Sku->contains($sku)) {
            $this->Sku->removeElement($sku);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
