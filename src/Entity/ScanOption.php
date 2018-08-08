<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScanOption
 *
 * @ORM\Entity(repositoryClass="App\Repository\ScanOptionRepository")
 */
class ScanOption
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
    private $option;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOption(): ?string
    {
        return $this->option;
    }

    public function setOption(string $option): self
    {
        $this->option = $option;

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

    public function data()
    {
        return  $this->getOption().' '.$this->getPrix();
    }
}
