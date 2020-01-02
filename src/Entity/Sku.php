<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkuRepository")
 */
class Sku
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product", mappedBy="Sku", cascade={"persist", "remove"})
     */
    private $product;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Choice", mappedBy="Sku")
     */
    private $choices;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Purchase", mappedBy="Sku")
     */
    private $purchases;


    public function __construct()
    {
        $this->choices = new ArrayCollection();
        $this->purchases = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        // set (or unset) the owning side of the relation if necessary
        $newSku = $product === null ? null : $this;
        if ($newSku !== $product->getSku()) {
            $product->setSku($newSku);
        }

        return $this;
    }

    /**
     * @return Collection|Choice[]
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choice $choice): self
    {
        if (!$this->choices->contains($choice)) {
            $this->choices[] = $choice;
            $choice->addSku($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        if ($this->choices->contains($choice)) {
            $this->choices->removeElement($choice);
            $choice->removeSku($this);
        }

        return $this;
    }

    /**
     * @return Collection|Purchase[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchass(Purchase $purchass): self
    {
        if (!$this->purchases->contains($purchass)) {
            $this->purchases[] = $purchass;
            $purchass->addSku($this);
        }

        return $this;
    }

    public function removePurchass(Purchase $purchass): self
    {
        if ($this->purchases->contains($purchass)) {
            $this->purchases->removeElement($purchass);
            $purchass->removeSku($this);
        }

        return $this;
    }

}
