<?php


namespace Corvus\Core\Helpers;


use NumberFormatter;

class Currency
{
    public static function format($price): string
    {
        $currency = config('corvus.currency');
        $fmt = new NumberFormatter( 'en_UK', NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($price, $currency)."\n";
    }
}
