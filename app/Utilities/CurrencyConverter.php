<?php

namespace App\Utilities;

use App\Models\Currency;

class CurrencyConverter
{
    public static function convert($amount, $from = 'USD', $to = 'USD')
    {
        if ($from === $to) {
            return round($amount, 2);
        }

        $rate = Currency::getRate($from, $to);
        return round($amount * $rate, 2);
    }

    public static function getSymbol($currency)
    {
        return Currency::getSymbol($currency);
    }
}
