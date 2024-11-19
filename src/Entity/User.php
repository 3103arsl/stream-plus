<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
class User extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api'])]
    private int $id;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Address::class, cascade: ['persist', 'remove'])]
    private Collection $addresses;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: PaymentMethod::class, cascade: ['persist', 'remove'])]
    private Collection $paymentMethods;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[Groups(['api'])]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\Unique]
    #[Groups(['api'])]
    private string $email;

    #[ORM\Column(type: Types::STRING, length: 10)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^\d{10}$/",
        message: "The phone number must be exactly 10 digits."
    )]
    #[Groups(['api'])]
    private string $phoneNumber;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: [1, 0], message: 'Choose a valid subscription type (0 for Free, 1 for Premium).')]
    #[Groups(['api'])]
    private int $subscriptionType;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->paymentMethods = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return self
     */
    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getSubscriptionType(): int
    {
        return $this->subscriptionType;
    }

    /**
     * @param int $subscriptionType
     * @return self
     */
    public function setSubscriptionType(int $subscriptionType): static
    {
        $this->subscriptionType = $subscriptionType;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    /**
     * @param Address $address
     * @return self
     */
    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
            $address->setUser($this);
        }
        return $this;
    }

    /**
     * @param Address $address
     * @return self
     */
    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // Set the owning side to null if necessary
            if ($address->getUser() === $this) {
                $address->setUser(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getPaymentMethods(): Collection
    {
        return $this->paymentMethods;
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return self
     */
    public function addPaymentMethod(PaymentMethod $paymentMethod): self
    {
        if (!$this->paymentMethods->contains($paymentMethod)) {
            $this->paymentMethods->add($paymentMethod);
            $paymentMethod->setUser($this);
        }
        return $this;
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return self
     */
    public function removePaymethod(PaymentMethod $paymentMethod): self
    {
        if ($this->addresses->removeElement($paymentMethod)) {
            // Set the owning side to null if necessary
            if ($paymentMethod->getUser() === $this) {
                $paymentMethod->setUser(null);
            }
        }
        return $this;
    }
}
