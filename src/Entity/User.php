<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deliveryAdressOne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deliveryAdressTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deliveryAdressThree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $additionalInformation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billingAdress;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Purchase", mappedBy="user")
     */
    private $Purchase;

    public function __construct()
    {
        $this->Purchase = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?bool
    {
        return $this->role;
    }

    public function setRole(bool $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDeliveryAdressOne(): ?string
    {
        return $this->deliveryAdressOne;
    }

    public function setDeliveryAdressOne(string $deliveryAdressOne): self
    {
        $this->deliveryAdressOne = $deliveryAdressOne;

        return $this;
    }

    public function getDeliveryAdressTwo(): ?string
    {
        return $this->deliveryAdressTwo;
    }

    public function setDeliveryAdressTwo(string $deliveryAdressTwo): self
    {
        $this->deliveryAdressTwo = $deliveryAdressTwo;

        return $this;
    }

    public function getDeliveryAdressThree(): ?string
    {
        return $this->deliveryAdressThree;
    }

    public function setDeliveryAdressThree(string $deliveryAdressThree): self
    {
        $this->deliveryAdressThree = $deliveryAdressThree;

        return $this;
    }

    public function getAdditionalInformation(): ?string
    {
        return $this->additionalInformation;
    }

    public function setAdditionalInformation(string $additionalInformation): self
    {
        $this->additionalInformation = $additionalInformation;

        return $this;
    }

    public function getBillingAdress(): ?string
    {
        return $this->billingAdress;
    }

    public function setBillingAdress(string $billingAdress): self
    {
        $this->billingAdress = $billingAdress;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Purchase[]
     */
    public function getPurchase(): Collection
    {
        return $this->Purchase;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->Purchase->contains($purchase)) {
            $this->Purchase[] = $purchase;
            $purchase->setUser($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        if ($this->Purchase->contains($purchase)) {
            $this->Purchase->removeElement($purchase);
            // set the owning side to null (unless already changed)
            if ($purchase->getUser() === $this) {
                $purchase->setUser(null);
            }
        }

        return $this;
    }
}
