<?php

namespace Corvus\Backoffice\Controllers;

use Corvus\Core\Models\Currency;
use Corvus\Core\Models\Setting;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function form()
    {
        $currencies = Currency::all()->pluck('currency', 'code');

        $currencies->prepend('----------');

        $settings = Setting::all();

        return view('backoffice.settings.form', compact('currencies', 'settings'));
    }

    public function update()
    {
        return view('backoffice.settings.form');
    }
}
