<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Offer

 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 */
class Offer
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
     * @var ViaboxAddress
     *
     * @ORM\ManyToOne(targetEntity="ViaboxAddress")
     */
    private $address;

    /**
     * @var Form
     *
     * @ORM\ManyToOne(targetEntity="Form")
     */
    private $form;

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

    public function getAddress(): ?ViaboxAddress
    {
        return $this->address;
    }

    public function setAddress(?ViaboxAddress $address): self
    {
        $this->address = $address;

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
}