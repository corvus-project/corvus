<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PricingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'from_date' => 'required|date|before_or_equal:'. date('Y-m-d'),
            'to_date'   => 'required|date|before_or_equal:'. date('Y-m-d'),
            'amount'    => 'required|numeric'
        ];
    }
}