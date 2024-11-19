<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\UniqueEmail;

class CreateUserDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    #[Assert\Length(max: 255)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[UniqueEmail]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^\d{10}$/",
        message: "The phone number must be exactly 10 digits."
    )]
    public ?string $phoneNumber = null;

    #[Assert\NotBlank]
    #[Assert\Choice(choices: [1, 2], message: 'Choose a valid subscription type (0 for Free, 1 for Premium).')]
    public ?int $subscriptionType;

    /**
     * @var AddressDTO[]
     */
    #[Assert\Valid]
    #[Assert\NotBlank]
    public array $addresses = [];

    /**
     * @var PaymentMethodDTO[]
     */
    #[Assert\Valid]
    #[Assert\NotBlank]
    public array $paymentMethods = [];
}
