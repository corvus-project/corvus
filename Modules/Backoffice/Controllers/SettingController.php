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

    public function update(Request $request)
    {
        $settings = Setting::all();
        foreach ($settings as $setting){
            $setting->setting_value = $request->get($setting->setting_key);
            $setting->save();
        }

        return redirect(route('backoffice.settings.form'))->withFlashSuccess(trans('Settings updated!'));
    }
}
