<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Customer

 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    use TimestampableEntity;

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
     * @Assert\Length(max=50)
     * @Assert\Regex(
     *     pattern="#[^a-zA-Z]#",
     *     match=false,
     *     message="Your name cannot contain a number or a special character"
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\Length(max=50)
     * @Assert\Regex(
     *     pattern="#[^a-zA-Z]#",
     *     match=false,
     *     message="Your name cannot contain a number or a special character"
     * )
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     *
     * @Assert\DateTime()
     */
    private $birthday;

    /**
     * @var int|null
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\Length(min=10,max=20)
     */
    private $phoneNumber;

    /**
     * @var int
     *
     * @ORM\Column(type="string")
     *
     * @Assert\Length(min=10,max=20)
     */
    private $phoneNumberSecondary;

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
     * @var CustomerAddress
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CustomerAddress", cascade={"persist"})
     */
    private $customerAddress;

    /**
     * @var \App\Entity\User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\User")*
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contract", inversedBy="customer")
     */
    private $contract;

    public function __construct()
    {
        $this->contract = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTime $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPhoneNumberSecondary(): ?int
    {
        return $this->phoneNumberSecondary;
    }

    public function setPhoneNumberSecondary(int $phoneNumberSecondary): self
    {
        $this->phoneNumberSecondary = $phoneNumberSecondary;

        return $this;
    }

    public function getSubscribeToNewsletter(): ?bool
    {
        return $this->subscribeToNewsletter;
    }

    public function setSubscribeToNewsletter(bool $subscribeToNewsletter): self
    {
        $this->subscribeToNewsletter = $subscribeToNewsletter;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getCompanyCommercialName(): ?string
    {
        return $this->companyCommercialName;
    }

    public function setCompanyCommercialName(?string $companyCommercialName): self
    {
        $this->companyCommercialName = $companyCommercialName;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getCompanyAddress(): ?string
    {
        return $this->companyAddress;
    }

    public function setCompanyAddress(?string $companyAddress): self
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    public function getCompanyZipCode(): ?string
    {
        return $this->companyZipCode;
    }

    public function setCompanyZipCode(?string $companyZipCode): self
    {
        $this->companyZipCode = $companyZipCode;

        return $this;
    }

    public function getCompanyCity(): ?string
    {
        return $this->companyCity;
    }

    public function setCompanyCity(?string $companyCity): self
    {
        $this->companyCity = $companyCity;

        return $this;
    }

    public function getCustomerAddress(): ?CustomerAddress
    {
        return $this->customerAddress;
    }

    public function setCustomerAddress(?CustomerAddress $customerAddress): self
    {
        $this->customerAddress = $customerAddress;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContract(): Collection
    {
        return $this->contract;
    }

    public function addContrat(Contract $contrat): self
    {
        if (!$this->contract->contains($contrat)) {
            $this->contract[] = $contrat;
        }

        return $this;
    }

    public function removeIdContrat(Contract $contrat): self
    {
        if ($this->contract->contains($contrat)) {
            $this->contract->removeElement($contrat);
        }

        return $this;
    }
}