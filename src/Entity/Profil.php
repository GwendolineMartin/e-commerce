<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfilRepository")
 */
class Profil
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $delivery_adress_one;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $delivery_adress_two;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $delivery_adress_three;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additional_information;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billing_adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDeliveryAdressOne(): ?string
    {
        return $this->delivery_adress_one;
    }

    public function setDeliveryAdressOne(string $delivery_adress_one): self
    {
        $this->delivery_adress_one = $delivery_adress_one;

        return $this;
    }

    public function getDeliveryAdressTwo(): ?string
    {
        return $this->delivery_adress_two;
    }

    public function setDeliveryAdressTwo(?string $delivery_adress_two): self
    {
        $this->delivery_adress_two = $delivery_adress_two;

        return $this;
    }

    public function getDeliveryAdressThree(): ?string
    {
        return $this->delivery_adress_three;
    }

    public function setDeliveryAdressThree(?string $delivery_adress_three): self
    {
        $this->delivery_adress_three = $delivery_adress_three;

        return $this;
    }

    public function getAdditionalInformation(): ?string
    {
        return $this->additional_information;
    }

    public function setAdditionalInformation(?string $additional_information): self
    {
        $this->additional_information = $additional_information;

        return $this;
    }

    public function getBillingAdress(): ?string
    {
        return $this->billing_adress;
    }

    public function setBillingAdress(string $billing_adress): self
    {
        $this->billing_adress = $billing_adress;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
