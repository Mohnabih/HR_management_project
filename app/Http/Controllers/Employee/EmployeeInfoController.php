<?php

namespace App\Http\Controllers\Employee;

use App\ApiCode;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeInfoController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * get employee managers.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function managers($id)
    {
        $managers = new EmployeeResource(Employee::find($id));
        if ($managers)
            return $this->sendResponse(
                $managers,
                "Here all menegers from the line manager until the founder.",
                ApiCode::SUCCESS,
                0
            );
        else return $this->sendResponse(
            null,
            "Not found",
            ApiCode::NOT_FOUND,
            0
        );
    }

    public function managersSalary($id)
    {
        $managers = new EmployeeResource(Employee::find($id));
        if ($managers)
            return $this->sendResponse(
                $managers,
                "Here all managers from the line manager until the founder.",
                ApiCode::SUCCESS,
                0
            );
        else return $this->sendResponse(
            null,
            "Not found",
            ApiCode::NOT_FOUND,
            0
        );
    }
}
