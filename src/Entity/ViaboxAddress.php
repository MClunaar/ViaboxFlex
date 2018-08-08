<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdresseDomiciliataire
 *
 * @ORM\Entity(repositoryClass="App\Repository\AdresseDomiciliataireRepository")
 */
class ViaboxAddress
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
    private $name;

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
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10)
     */
    private $codeNaf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10)
     */
    private $codeApe;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $phone;

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

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getCodeNaf(): ?string
    {
        return $this->codeNaf;
    }

    public function setCodeNaf(string $codeNaf): self
    {
        $this->codeNaf = $codeNaf;

        return $this;
    }

    public function getCodeApe(): ?string
    {
        return $this->codeApe;
    }

    public function setCodeApe(string $codeApe): self
    {
        $this->codeApe = $codeApe;

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
}
