<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePayment
 *
 * @ORM\Entity(repositoryClass="App\Repository\TypePaymentRepository")
 */
class TypePayment
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
     * @ORM\Column(type="string", length=20)
     */
    private $typePayment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePayment(): ?string
    {
        return $this->typePayment;
    }

    public function setTypePayment(string $typePayment): self
    {
        $this->typePayment = $typePayment;

        return $this;
    }
}
