<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Product
 *@ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     **/

    private $id;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var ViaboxAddress
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ViaboxAddress")
     *
     */
    private $viaboxAddress;
    /**
     * @var Form
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Form")
     *
     */
    private $form;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getViaboxAddress(): ?ViaboxAddress
    {
        return $this->viaboxAddress;
    }

    public function setViaboxAddress(?ViaboxAddress $viaboxAddress): self
    {
        $this->viaboxAddress = $viaboxAddress;

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