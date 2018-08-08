<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Prospect

 * @ORM\Entity(repositoryClass="App\Repository\ProspectRepository")
 */
class Prospect
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
     * @var string|null
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lastName;


	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	private $address;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	private $address2;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=40, nullable=true)
	 */
	private $country;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	private $city;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $zipCode;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=20, nullable=true)
	 *
	 * @Assert\Length(min=8,max=20)
	 * @Assert\Regex(
	 *     pattern="#[^a-zA-Z0-9]#",
	 *     match=false,
	 *     message="Your name cannot contain a number or a special character"
	 * )
	 */
	private $siret;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=40, nullable=true)
	 *
	 * @Assert\Length(min=8,max=20)
	 * @Assert\Regex(
	 *     pattern="#[^a-zA-Z0-9]#",
	 *     match=false,
	 *     message="Your name cannot contain a number or a special character"
	 * )
	 */
	private $companyCommercialName;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=40, nullable=true)
	 */
	private $companyName;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	private $companyAddress;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=10, nullable=true)
	 *
	 * @Assert\Length(min=4,max=6)
	 * @Assert\Regex(
	 *     pattern="#[^0-9]#",
	 *     match=false,
	 *     message="Your name cannot contain a number or a special character"
	 * )
	 */
	private $companyZipCode;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=25, nullable=true)
	 *
	 * @Assert\Length(min=3,max=20)
	 * @Assert\Regex(
	 *     pattern="#[^a-zA-Z]#",
	 *     match=false,
	 *     message="Your name cannot contain a number or a special character"
	 * )
	 */
	private $companyCity;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $phoneNumberSecondary;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $website;

	/**
	 * @var Type
	 *
	 * @ORM\ManyToOne(targetEntity="Type")
	 */
	private $type;

	/**
	 * @var Form
	 *
	 * @ORM\ManyToOne(targetEntity="Form")
	 */
	private $form;

	/**
	 * @var User
	 * @ORM\OneToOne(targetEntity="User", mappedBy="prospect")
	 */
	private $user;

	/**
	 * @var Customer
	 * @ORM\OneToOne(targetEntity="Customer", mappedBy="prospect")
	 */
	private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPhoneNumberSecondary(): ?string
    {
        return $this->phoneNumberSecondary;
    }

    public function setPhoneNumberSecondary(?string $phoneNumberSecondary): self
    {
        $this->phoneNumberSecondary = $phoneNumberSecondary;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
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

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @param User $user
	 */
	public function setUser( User $user ): void {
		$this->user = $user;
	}

	/**
	 * @return Type
	 */
	public function getType(): Type {
		return $this->type;
	}

	/**
	 * @param Type $type
	 */
	public function setType( Type $type ): void {
		$this->type = $type;
	}

	/**
	 * @return Customer
	 */
	public function getCustomer(): Customer {
		return $this->customer;
	}

	/**
	 * @param Customer $customer
	 */
	public function setCustomer( Customer $customer ): void {
		$this->customer = $customer;
	}

	/**
	 * @return null|string
	 */
	public function getZipCode(): ?string {
		return $this->zipCode;
	}

	/**
	 * @param null|string $zipCode
	 */
	public function setZipCode( ?string $zipCode ): void {
		$this->zipCode = $zipCode;
	}

	/**
	 * @return string
	 */
	public function getSiret(): string {
		return $this->siret;
	}

	/**
	 * @param string $siret
	 */
	public function setSiret( string $siret ): void {
		$this->siret = $siret;
	}

	/**
	 * @return null|string
	 */
	public function getCompanyCommercialName(): ?string {
		return $this->companyCommercialName;
	}

	/**
	 * @param null|string $companyCommercialName
	 */
	public function setCompanyCommercialName( ?string $companyCommercialName ): void {
		$this->companyCommercialName = $companyCommercialName;
	}

	/**
	 * @return null|string
	 */
	public function getCompanyName(): ?string {
		return $this->companyName;
	}

	/**
	 * @param null|string $companyName
	 */
	public function setCompanyName( ?string $companyName ): void {
		$this->companyName = $companyName;
	}

	/**
	 * @return null|string
	 */
	public function getCompanyAddress(): ?string {
		return $this->companyAddress;
	}

	/**
	 * @param null|string $companyAddress
	 */
	public function setCompanyAddress( ?string $companyAddress ): void {
		$this->companyAddress = $companyAddress;
	}

	/**
	 * @return null|string
	 */
	public function getCompanyZipCode(): ?string {
		return $this->companyZipCode;
	}

	/**
	 * @param null|string $companyZipCode
	 */
	public function setCompanyZipCode( ?string $companyZipCode ): void {
		$this->companyZipCode = $companyZipCode;
	}

	/**
	 * @return null|string
	 */
	public function getCompanyCity(): ?string {
		return $this->companyCity;
	}

	/**
	 * @param null|string $companyCity
	 */
	public function setCompanyCity( ?string $companyCity ): void {
		$this->companyCity = $companyCity;
	}

	/**
	 * @return null|string
	 */
	public function getWebsite(): ?string {
		return $this->website;
	}

	/**
	 * @param null|string $website
	 */
	public function setWebsite( ?string $website ): void {
		$this->website = $website;
	}

	/**
	 * @return Form
	 */
	public function getForm(): Form {
		return $this->form;
	}

	/**
	 * @param Form $form
	 */
	public function setForm( Form $form ): void {
		$this->form = $form;
	}
}
