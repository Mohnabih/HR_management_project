<?php

namespace App\Http\Controllers\Employee;

use App\ApiCode;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\StoreEmployeeRequest;
use App\Http\Requests\Api\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = Employee::whereNull('founder_id');
        $limit = 12;
        if ($request->query('limit') != null)
            $limit = $request->query('limit');
        $page = 1;
        if ($request->query('page') != null)
            $page = $request->query('page');
        $data = $employees->paginate($limit)->toArray();
        $data['items'] = $data['data'];
        unset($data['data']);
        return $this->sendResponse(
            $data,
            "Here are all employees",
            ApiCode::SUCCESS,
            0
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $input = $request->validated();
        $employee = Employee::create($input);
        return $this->sendResponse(
            [
                "employee" => Employee::find($employee->id)
            ],
            "employee created successfully",
            ApiCode::CREATED,
            0
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if ($employee)
            return $this->sendResponse(
                [
                    "employee" => $employee
                ],
                "employee info",
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $input = $request->validated();
        $employee = Employee::find($id);
        $employee->update($input);
        return $this->sendResponse(
            [
                "employee" => Employee::find($employee->id)
            ],
            "employee updated successfully",
            ApiCode::SUCCESS,
            0
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return $this->sendResponse(
                null,
                "employee deleted successfully",
                ApiCode::SUCCESS,
                0
            );
        } else return $this->sendResponse(
            null,
            "Not found",
            ApiCode::NOT_FOUND,
            0
        );
    }
}
