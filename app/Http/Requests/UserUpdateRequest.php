<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users,email,'. $this->user->id,
            "password" => "required_if:password_confirmation,!=,null|nullable|confirmed|min:6",
            "password_confirmation" => 'nullable',
            'name'  => 'required|min:3|max:100',
            'stock_group_id' => 'required|exists:stock_groups,id',
            'pricing_group_id' => 'required|exists:pricing_groups,id',
        ];
    }
}