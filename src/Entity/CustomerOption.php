<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerOption
 * @ORM\Entity(repositoryClass="App\Repository\CustomerOptionRepository")
 */
class CustomerOption
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
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $toDate;

    /**
     * @var ViaboxAddress
     *
     * @ORM\ManyToOne(targetEntity="ViaboxAddress")
     */
    private $domiciliataire;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer")
     */
    private $customer;

    /**
     * @var MailOption
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\MailOption")
     */
    private $mail;

    /**
     * @var ScanOption
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ScanOption")
     */
    private $scan;

    /**
     * @var Form
     *
     * @ORM\ManyToOne(targetEntity="Form")
     */
    private $form;

	/**
	 * @var Contract
	 *
	 * @ORM\OneToOne(targetEntity= "App\Entity\Contract", mappedBy="customerOption")
	 */
	private $contract;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(\DateTimeInterface $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
    }

    public function getDomiciliataire(): ?ViaboxAddress
    {
        return $this->domiciliataire;
    }

    public function setDomiciliataire(?ViaboxAddress $domiciliataire): self
    {
        $this->domiciliataire = $domiciliataire;

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

    public function getMail(): ?MailOption
    {
        return $this->mail;
    }

    public function setMail(?MailOption $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getScan(): ?ScanOption
    {
        return $this->scan;
    }

    public function setScan(?ScanOption $scan): self
    {
        $this->scan = $scan;

        return $this;
    }

    public function getForm(): ?Form
    {
        return $this->form;
    }

    public function setForm(?Form $form): self
    {
        $this->form = $form;

        return $this;
    }

	/**
	 * @return Contract
	 */
	public function getContract(): Contract {
		return $this->contract;
	}

	/**
	 * @param Contract $contract
	 *
	 * @return CustomerOption
	 */
	public function setContract( Contract $contract ): self {
		$this->contract = $contract;

		return $this;
	}
}
