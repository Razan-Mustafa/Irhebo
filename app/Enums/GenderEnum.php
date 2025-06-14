<?php

namespace App\Enums;

enum GenderEnum: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    public function label(): string
    {
        return match ($this) {
            self::MALE => __('male'),
            self::FEMALE => __('female'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
