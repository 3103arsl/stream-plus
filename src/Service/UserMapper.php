<?php

namespace App\Service;

use App\DTO\CreateUserDTO;
use App\Entity\PaymentMethod;
use App\Entity\User;
use App\Entity\Address;

class UserMapper
{
    public function mapToEntity(CreateUserDTO $userDTO): User
    {
        $user = new User();
        $user->setName($userDTO->name)
            ->setEmail($userDTO->email)
            ->setPhoneNumber($userDTO->phoneNumber)
            ->setSubscriptionType($userDTO->subscriptionType);

        foreach ($userDTO->addresses as $addressDTO) {
            $address = new Address();
            $address->setLine1($addressDTO->line1)
                ->setLine2($addressDTO->line2)
                ->setCity($addressDTO->city)
                ->setState($addressDTO->state)
                ->setPostalCode($addressDTO->postalCode)
                ->setCountry($addressDTO->country);
            $user->addAddress($address);
        }

        foreach ($userDTO->paymentMethods as $paymentMethodDTO) {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->setCardNumber($paymentMethodDTO->cardNumber)
                ->setExpirationDate($paymentMethodDTO->expirationDate)
                ->setCvv($paymentMethodDTO->cvv);
            $user->addPaymentMethod($paymentMethod);
        }

        return $user;
    }
}
