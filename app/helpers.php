<?php

/**
 * Global helpers file with misc functions.
 */

if (!function_exists('__trans_choice')) {
    /**
     * Translates the given message based on a count from json key.
     *
     * @param $key
     * @param $number
     * @param array $replace
     * @param null $locale
     * @return string
     */
    function __trans_choice($key, $number, array $replace = [], $locale = null)
    {
        return trans_choice(__($key), $number, $replace, $locale);
    }
}

if (!function_exists('isAdmin')) {
    /**
     * Is Admin
     *
     * @return bool
     */
    function isAdmin($default = '/')
    {
        $user = \Auth::user();

        return $user->hasRole('administrator');
    }
}

if (!function_exists('redirectToDashboad')) {
    /**
     * Redirect To Dashboard
     *
     * @param string $default
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function redirectToDashboad($default = '/')
    {
        if (isAdmin()) {
            return redirect('/admin');
        }

        return redirect($default);
    }
}

if (!function_exists('productNameBySku')) {
    function productNameBySku($sku)
    {
        $product = App\Models\Product::where('sku', $sku)->first();
        if ($product) {
            return $product->name;
        }

        return false;
    }
}

if (!function_exists('updateOrderStatus')) {
    function updateOrderStatus($status)
    {
        switch ($status) {
            case 'APPROVED':
                return 'PACKED';
                break;

            case 'PACKED':
                return 'READY_TO_SHIP';
                break;

            case 'READY_TO_SHIP':
                return 'SHIPPED';
                break;

            case 'SHIPPED':
                return 'COMPLETED';
                break;

            default:
                return 'FAILED';
                break;
        }
    }
}
