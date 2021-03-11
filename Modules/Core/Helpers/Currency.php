<?php


namespace Corvus\Core\Helpers;


use NumberFormatter;

class Currency
{
    public static function format($amount): string
    {
        $currency = config('corvus.currency');
        $fmt = new NumberFormatter( 'en_UK', NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($amount, $currency)."\n";
    }
}
