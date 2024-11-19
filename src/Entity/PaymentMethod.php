<?php

namespace App\Entity;

use App\Repository\PaymentMethodRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PaymentMethodRepository::class)]
#[ORM\Table(name: '`user_payment_methods`')]
class PaymentMethod extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'paymentMethods')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: Types::STRING, length: 16)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{16}$/',
        message: 'Credit card number must be exactly 16 digits.'
    )]
    private string $cardNumber;

    #[ORM\Column(type: Types::STRING, length: 5)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^(0[1-9]|1[0-2])\/\d{2}$/',
        message: 'Expiration date must be in MM/YY format.'
    )]
    private string $expirationDate;

    #[ORM\Column(type: Types::STRING, length: 3)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{3}$/',
        message: 'CVV must be exactly 3 digits.'
    )]
    private string $cvv;


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
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     * @return self
     */
    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    /**
     * @param string $expirationDate
     * @return self
     */
    public function setExpirationDate(string $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getCvv(): string
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     * @return self
     */
    public function setCvv(string $cvv): self
    {
        $this->cvv = $cvv;

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
