<?php

namespace App\Observers;

use App\Mail\SendEmail;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
                "description" => "This employee has been created",
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
                "description" => "This employee has been updated",
                "employee" => $employee
            ]
        );
        Log::stack(['slack', $this->channel])->info($data);
        $isChanged = $employee->wasChanged('salary') ? true : false;
        if ($isChanged) {
            $email['email_title'] ="Hi ".$employee->name;
            $email['email_body'] ="We would like to inform you that there has been a change in your salary.\n Your new salary is ".$employee->salary."$";
            //senda an email to the employee
            Mail::to($employee->email)
                ->send(new SendEmail($email));
        }
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
                "description" => "This employee has been deleted",
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
