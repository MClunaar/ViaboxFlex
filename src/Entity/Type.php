<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Type

 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
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
     * @ORM\Column(type="string", length=50)
     */
    private $name;

	/**
	 * @var ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="Form", mappedBy="type")
	 */
	private $forms;

	/**
	 * Type constructor.
	 */
	public function __construct() {
		$this->forms = new ArrayCollection();
	}


	public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

	/**
	 * @return ArrayCollection
	 */
	public function getForms(): ArrayCollection {
		return $this->forms;
	}
}