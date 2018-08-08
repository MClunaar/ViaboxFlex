<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Production
 *
 * @ORM\Entity(repositoryClass="App\Repository\ProductionRepository")
 */
class Production
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
    private $dateReceipt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $dateProcessing;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     */
    private $format;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=true)
     */
    private $poids;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $nbPages;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $optionScan;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $optionMail;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $optionDelete;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer")
     */
    private $customer;

    /**
     * @var ShipperAddress
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ShipperAddress")
     */
    private $shipperAddress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReceipt(): ?\DateTimeInterface
    {
        return $this->dateReceipt;
    }

    public function setDateReceipt(\DateTimeInterface $dateReceipt): self
    {
        $this->dateReceipt = $dateReceipt;

        return $this;
    }

    public function getDateProcessing(): ?\DateTimeInterface
    {
        return $this->dateProcessing;
    }

    public function setDateProcessing(\DateTimeInterface $dateProcessing): self
    {
        $this->dateProcessing = $dateProcessing;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(?float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getNbPages(): ?int
    {
        return $this->nbPages;
    }

    public function setNbPages(int $nbPages): self
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    public function getOptionScan(): ?string
    {
        return $this->optionScan;
    }

    public function setOptionScan(?string $optionScan): self
    {
        $this->optionScan = $optionScan;

        return $this;
    }

    public function getOptionMail(): ?string
    {
        return $this->optionMail;
    }

    public function setOptionMail(?string $optionMail): self
    {
        $this->optionMail = $optionMail;

        return $this;
    }

    public function getOptionDelete(): ?string
    {
        return $this->optionDelete;
    }

    public function setOptionDelete(?string $optionDelete): self
    {
        $this->optionDelete = $optionDelete;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getShipperAddress(): ?ShipperAddress
    {
        return $this->shipperAddress;
    }

    public function setShipperAddress(?ShipperAddress $shipperAddress): self
    {
        $this->shipperAddress = $shipperAddress;

        return $this;
    }
}
