<?php

namespace App\Enums;

enum RequestStatusEnum: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case IN_PROGRESS = 'in_progress';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('pending'),
            self::CONFIRMED => __('confirmed'),
            self::IN_PROGRESS => __('in_progress'),
            self::CANCELLED => __('cancelled'),
            self::COMPLETED => __('completed'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    public function badge(): string
    {
        $classes = match ($this) {
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::IN_PROGRESS => 'bg-primary text-white',
            self::COMPLETED => 'bg-green-100 text-green-800',
            self::CONFIRMED => 'bg-gray-200 text-gray-700',
            self::CANCELLED => 'bg-danger text-white',
        };

        return '<span class="inline-block px-3 py-1 text-xs font-medium rounded-full ' . $classes . '">'
            . $this->label() .
            '</span>';
    }
}
