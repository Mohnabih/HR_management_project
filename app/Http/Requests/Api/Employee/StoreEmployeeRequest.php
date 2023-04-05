<?php

namespace App\Http\Requests\Api\Employee;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends BaseRequest
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
        return [
            'manager_id'=>'integer|exists:employees,id',
            'name'=>'required|string|max:150',
            'age'=>'required|numeric|min:18',
            'gender'=>'required|integer|in:0,1',
            'email'=>'required|email:filter|max:255|unique:employees',
            'salary'=>'required|integer',
            'job_title'=>'required|string|max:150',
            'hired_date'=>'required|date'

        ];
    }
}
