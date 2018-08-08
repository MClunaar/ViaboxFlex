<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Entity(repositoryClass="App\Repository\ContratRepository")
 */
class Contract
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
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $startedAt;

	/**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $endedAt;

	/**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0)
     */
    private $price;

	/**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @var CustomerOption
     *
     * @ORM\OneToOne(targetEntity= "App\Entity\CustomerOption", inversedBy="contract", cascade={"persist"})
     */
    private $customerOption;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="contracts", cascade={"persist"})
     */
    private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getCustomerOption(): ?CustomerOption
    {
        return $this->customerOption;
    }

    public function setCustomerOption(?CustomerOption $customerOption): self
    {
        $this->customerOption = $customerOption;

        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
