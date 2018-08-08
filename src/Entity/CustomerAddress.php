<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * CustomerAddress
 * @ORM\Entity(repositoryClass="App\Repository\CustomerAddressRepository")
 */
class CustomerAddress
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
     *
     * @Assert\Length(min=3, max=50)
     * @Assert\Regex(
     *     pattern="#[^a-zA-Z0-9,-.:_ ]#",
     *     match=false,
     *     message="Your name cannot contain a number or a special character"
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\Length(min=3, max=50)
     * @Assert\Regex(
     *     pattern="#[^a-zA-Z0-9,-.:_ ]#",
     *     match=false,
     *     message="Your name cannot contain a number or a special character"
     * )
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(min=2, max=50)
     * @Assert\Regex(
     *     pattern="#[^a-zA-Z-]#",
     *     match=false,
     *     message="Your name cannot contain a number or a special character"
     * )
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\Length(min=3, max=50)
     * @Assert\Regex(
     *     pattern="#[^a-zA-Z,-.:']#",
     *     match=false,
     *     message="Your name cannot contain a number or a special character"
     * )
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     *
     * @Assert\Length(min=3, max=15)
     * @Assert\Regex(
     *     pattern="#[^a-zA-Z0-9,-.:']#",
     *     match=false,
     *     message="Your name cannot contain a number or a special character"
     * )
     */
    private $codePostal;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $activeAddress;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setAddress2(string $address2): self
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

    public function getActiveAddress(): ?bool
    {
        return $this->activeAddress;
    }

    public function setActiveAddress(bool $activeAddress): self
    {
        $this->activeAddress = $activeAddress;

        return $this;
    }
}
