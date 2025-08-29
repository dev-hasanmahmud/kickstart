<?php

namespace App\Enums;

enum Status: int
{
    case Inactive = 0;
    case Active = 1;
    case Draft = 2;

    public function label(): string
    {
        return match($this) {
            self::Inactive => 'Inactive',
            self::Active   => 'Active',
            self::Draft    => 'Draft',
        };
    }

    public static function options(): array
    {
        return [
            self::Inactive->value => self::Inactive->label(),
            self::Active->value   => self::Active->label(),
            self::Draft->value    => self::Draft->label(),
        ];
    }
}
