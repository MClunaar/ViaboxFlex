<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice
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
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0)
     */
    private $sum;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", precision=10, scale=0, nullable=true)
     */
    private $pdf;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0)
     */
    private $debit;

    /**
     * @var Contract
     *
     * @ORM\ManyToOne(targetEntity="Contract")
     */
    private $contrat;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Payment", mappedBy="invoices")
     */
    private $payment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\InvoiceLine", mappedBy="invoices")
     */
    private $line;

    public function __construct()
    {
        $this->payment = new ArrayCollection();
        $this->line = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSum(): ?float
    {
        return $this->sum;
    }

    public function setSum(float $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }

    public function getDebit(): ?float
    {
        return $this->debit;
    }

    public function setDebit(float $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getContrat(): ?Contract
    {
        return $this->contrat;
    }

    public function setContrat(?Contract $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPayment(): Collection
    {
        return $this->payment;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->payment->contains($payment)) {
            $this->payment[] = $payment;
            $payment->addInvoice($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payment->contains($payment)) {
            $this->payment->removeElement($payment);
            $payment->removeInvoice($this);
        }

        return $this;
    }

    /**
     * @return Collection|InvoiceLine[]
     */
    public function getLine(): Collection
    {
        return $this->line;
    }

    public function addLine(InvoiceLine $line): self
    {
        if (!$this->line->contains($line)) {
            $this->line[] = $line;
            $line->addInvoice($this);
        }

        return $this;
    }

    public function removeLine(InvoiceLine $line): self
    {
        if ($this->line->contains($line)) {
            $this->line->removeElement($line);
            $line->removeInvoice($this);
        }

        return $this;
    }
}
