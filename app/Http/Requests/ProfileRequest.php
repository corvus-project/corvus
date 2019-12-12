<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Auth;
class ProfileRequest extends FormRequest
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
        $user_id = Auth::user()->id;
        return [
            'email' => 'required|string|email|max:255|unique:users,email,'. $user_id,
            "password" => "required_if:password_confirmation,!=,null|nullable|confirmed|min:6",
            'name'  => 'required|min:3|max:100',
        ];
    }
}