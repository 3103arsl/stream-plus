<?php

namespace App\Enum;

enum SubscriptionType: int
{

    case Free = 1;
    case Premium = 2;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Free => 'Free',
            self::Premium => 'Premium',
        };
    }
}