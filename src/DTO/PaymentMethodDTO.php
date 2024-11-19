<?php

namespace App\DTO;

use App\Entity\User;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

class PaymentMethodDTO
{
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{16}$/',
        message: 'Credit card number must be exactly 16 digits.'
    )]
    public string $cardNumber;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^(0[1-9]|1[0-2])\/\d{2}$/',
        message: 'Expiration date must be in MM/YY format.'
    )]
    public string $expirationDate;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{3}$/',
        message: 'CVV must be exactly 3 digits.'
    )]
    public string $cvv;
}