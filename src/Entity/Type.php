<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
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
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="type")
     */
    private $Product;

    public function __construct()
    {
        $this->Product = new ArrayCollection();
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

    /**
     * @return Collection|Product[]
     */
    public function getProduct(): Collection
    {
        return $this->Product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->Product->contains($product)) {
            $this->Product[] = $product;
            $product->setType($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->Product->contains($product)) {
            $this->Product->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getType() === $this) {
                $product->setType(null);
            }
        }

        return $this;
    }
}
