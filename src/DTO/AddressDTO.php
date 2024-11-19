<?php

namespace App\DTO;

use App\Entity\User;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

class AddressDTO
{
    private User $user;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    public string $line1;

    #[Assert\Length(max: 255)]
    public ?string $line2 = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    public string $city;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    public string $state;

    #[Assert\NotBlank]
    #[Assert\Length(max: 15)]
    #[Assert\Regex("/^\d{5,10}$/", message: "Invalid postal code.")]
    public string $postalCode;

    #[Assert\NotBlank]
    #[Assert\Length(max: 3)]
    public string $country;
}