<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
	use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;

	/**
	 * @ORM\Column(type="string")
	 */
	private $email;

	/**
	 * @ORM\Column(type="simple_array")
	 */
	private $roles;

	/**
	 * @ORM\Column(name="is_active", type="boolean")
	 */
	private $isActive;

	/**
	 * @var Prospect
	 * @ORM\OneToOne(targetEntity="Prospect", inversedBy="user")
	 */
	private $prospect;

	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="UserHistory", mappedBy="user")
	 */
	private $histories;
	/**
	 * User constructor.
	 */
	public function __construct() {
		$this->roles = ['ROLE_USER'];
		$this->isActive = false;
		$this->histories = new ArrayCollection();
	}

	public function getId(): ?int
    {
        return $this->id;
    }

    // <UserInterface>
	public function getRoles() {
		return $this->roles;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getSalt() {
		return null;
	}

	public function getUsername() {
		return $this->email;
	}

	public function eraseCredentials() {
	}
	// </UserInterface>

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail( $email ): void {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function isActive() {
		return $this->isActive;
	}

	/**
	 * @param mixed $active
	 */
	public function setActive( $active ): void {
		$this->isActive = $active;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword( $password ): void {
		$this->password = $password;
	}

	/**
	 * @return Prospect
	 */
	public function getProspect(): Prospect {
		return $this->prospect;
	}

	/**
	 * @param Prospect $prospect
	 */
	public function setProspect( Prospect $prospect ): void {
		$this->prospect = $prospect;
	}

	/**
	 * @return Collection
	 */
	public function getHistories(): Collection {
		return $this->histories;
	}

	public function addHistory(UserHistory $history) {
		$this->histories->add($history);
	}


}
