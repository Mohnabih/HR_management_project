<?php

namespace App\Http\Requests\Api;

use App\ApiCode;
use App\Http\Controllers\AppBaseController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BaseRequest extends FormRequest
{  private AppBaseController $AppBaseController;
    public function __construct(AppBaseController $AppBaseController)
    {
        $this->AppBaseController = $AppBaseController;
    }


    protected function failedValidation(Validator $validator)
    {
        $response = $this->AppBaseController->sendResponse(
            $validator->errors(),
            "validation errors",
            ApiCode::BAD_REQUEST,
            1
        );
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
