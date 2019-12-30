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

if(!function_exists('isAdmin'))
{
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

if(!function_exists('redirectToDashboad'))
{
    /**
     * Redirect To Dashboard
     *
     * @param string $default
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function redirectToDashboad($default = '/')
    {
        if(isAdmin())
        {
            return redirect('/admin');    
        }
        
        return redirect($default);
    }
}