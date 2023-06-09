<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends BaseRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return  [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
