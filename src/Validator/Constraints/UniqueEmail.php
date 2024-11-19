<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD)]
class UniqueEmail extends Constraint
{
    /** @var string  */
    public $message = 'The email "{{ value }}" is already taken.';

    /**
     * @return string
     */
    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}