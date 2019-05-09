<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StockMoving", mappedBy="user")
     */
    private $StokMovingAction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $Address;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $EntryDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $departureDate;

    public function __construct()
    {
        $this->StokMovingAction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|StockMoving[]
     */
    public function getStokMovingAction(): Collection
    {
        return $this->StokMovingAction;
    }

    public function addStokMovingAction(StockMoving $stokMovingAction): self
    {
        if (!$this->StokMovingAction->contains($stokMovingAction)) {
            $this->StokMovingAction[] = $stokMovingAction;
            $stokMovingAction->setUser($this);
        }

        return $this;
    }

    public function removeStokMovingAction(StockMoving $stokMovingAction): self
    {
        if ($this->StokMovingAction->contains($stokMovingAction)) {
            $this->StokMovingAction->removeElement($stokMovingAction);
            // set the owning side to null (unless already changed)
            if ($stokMovingAction->getUser() === $this) {
                $stokMovingAction->setUser(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAddress()
    {
        return $this->Address;
    }

    public function setAddress($Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getEntryDate(): ?DateTimeInterface
    {
        return $this->EntryDate;
    }

    public function setEntryDate(?DateTimeInterface $EntryDate): self
    {
        $this->EntryDate = $EntryDate;

        return $this;
    }

    public function getDepartureDate(): ?DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(?DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }
}
