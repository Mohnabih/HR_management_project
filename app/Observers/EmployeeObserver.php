<?php

namespace App\Observers;

use App\Models\Employee;
use Illuminate\Support\Facades\Log;

class EmployeeObserver
{
    private $channel;
    public function __construct()
    {
        $this->channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/Hr_activites.log'),
        ]);
    }
    /**
     * Handle the Employee "created" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        $data = json_encode(
            [
               "description"=> "This employee has been created",
                "employee" => $employee
            ]
        );
        Log::stack(['slack', $this->channel])->info($data);
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        $data = json_encode(
            [
               "description"=> "This employee has been updated",
                "employee" => $employee
            ]
        );
        Log::stack(['slack', $this->channel])->info($data);
    }

    /**
     * Handle the Employee "deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        $data = json_encode(
            [
               "description"=> "This employee has been deleted",
                "employee" => $employee
            ]
        );
        Log::stack(['slack', $this->channel])->info($data);
    }

    /**
     * Handle the Employee "restored" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        //
    }
}
