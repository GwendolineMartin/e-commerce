<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChoiceRepository")
 */
class Choice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", mappedBy="Choice")
     */
    private $products;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sku", inversedBy="choices")
     */
    private $Sku;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->Sku = new ArrayCollection();
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addChoice($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->removeChoice($this);
        }

        return $this;
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
}
