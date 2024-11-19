<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ORM\Table(name: '`user_address`')]
class Address extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'addresses')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $line1;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $line2 = null;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    private string $city;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    private string $state;

    #[ORM\Column(type: Types::STRING, length: 15)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 15)]
    #[Assert\Regex("/^\d{5,10}$/", message: "Invalid postal code.")]
    private string $postalCode;

    #[ORM\Column(type: Types::STRING, length: 3)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 3)]
    private string $country;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLine1(): string
    {
        return $this->line1;
    }

    /**
     * @param string $line1
     * @return self
     */
    public function setLine1(string $line1): self
    {
        $this->line1 = $line1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLine2(): ?string
    {
        return $this->line2;
    }

    /**
     * @param string $line2
     * @return Address
     */
    public function setLine2(?string $line2 = null): self
    {
        $this->line2 = $line2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return self
     */
    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return self
     */
    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return self
     */
    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return self
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
