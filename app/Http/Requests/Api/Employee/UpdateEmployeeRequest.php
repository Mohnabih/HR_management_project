<?php

namespace App\Http\Requests\Api\Employee;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends BaseRequest
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
            'category'=>'integer|in:0,1',
            'manager_id'=>'integer|exists:employees,id',
            'founder_id'=>'integer|exists:founders,id',
            'name'=>'string|max:150',
            'age'=>'numeric|min:18',
            'gender'=>'integer|in:0,1',
            'email'=>'email:filter|max:255|unique:employees',
            'salary'=>'integer',
            'job_title'=>'string|max:150',
        ];
    }
}
