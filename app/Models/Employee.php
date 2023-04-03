<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Employee extends Model
{
    use HasFactory, LogsActivity;

    protected $dates = ['hired_date'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manager_id',
        'founder_id',
        'name',
        'age',
        'gender',
        'email',
        'salary',
        'job_title',
        'category',
        'hired_date'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','email','job_title', 'salary','manager.name'])
            ->setDescriptionForEvent(fn(string $eventName) => "This employee has been {$eventName}");
        // Chain fluent methods for configuration options
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'manager_id' => 'integer',
        'founder_id' => 'integer',
        'name' => 'string',
        'age' => 'integer',
        'gender' => 'boolean',
        'email' => 'string',
        'salary' => 'integer',
        'job_title' => 'string',
        'category' => 'integer',
    ];

    /**
     * Get the manger that owns the employees.
     */
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    /**
     * The manager that belong to the founder.
     */
    public function founder()
    {
        return;
    }
}
