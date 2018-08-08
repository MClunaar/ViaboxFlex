<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipperAddress
 *
 * @ORM\Entity(repositoryClass="App\Repository\ShipperAddressRepository")
 */
class ShipperAddress
{
	/**
	 * @var int
	 *
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=25)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $codePostal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }
}
