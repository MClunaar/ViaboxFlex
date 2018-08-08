<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
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
    private $payment;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $numTransaction;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0)
     */
    private $amount;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer")
     */
    private $customer;

    /**
     * @var TypePayment
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePayment")
     */
    private $typePayment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Invoice", inversedBy="payment")
     */
    private $invoices;

    public function __construct()
    {
        $this->invoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayment(): ?\DateTimeInterface
    {
        return $this->payment;
    }

    public function setPayment(\DateTimeInterface $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getNumTransaction(): ?int
    {
        return $this->numTransaction;
    }

    public function setNumTransaction(int $numTransaction): self
    {
        $this->numTransaction = $numTransaction;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

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

    public function getTypePayment(): ?TypePayment
    {
        return $this->typePayment;
    }

    public function setTypePayment(?TypePayment $typePayment): self
    {
        $this->typePayment = $typePayment;

        return $this;
    }

    /**
     * @return Collection|Invoice[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoices->contains($invoice)) {
            $this->invoices->removeElement($invoice);
        }

        return $this;
    }
}
