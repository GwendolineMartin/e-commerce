<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="Product")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="Product")
     */
    private $brand;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Sku", inversedBy="product", cascade={"persist", "remove"})
     */
    private $Sku;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Choice", inversedBy="products")
     */
    private $Choice;

    public function __construct()
    {
        $this->Choice = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getSku(): ?Sku
    {
        return $this->Sku;
    }

    public function setSku(?Sku $Sku): self
    {
        $this->Sku = $Sku;

        return $this;
    }

    /**
     * @return Collection|Choice[]
     */
    public function getChoice(): Collection
    {
        return $this->Choice;
    }

    public function addChoice(Choice $choice): self
    {
        if (!$this->Choice->contains($choice)) {
            $this->Choice[] = $choice;
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        if ($this->Choice->contains($choice)) {
            $this->Choice->removeElement($choice);
        }

        return $this;
    }
}
