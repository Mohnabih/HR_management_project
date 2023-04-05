<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $dates = ['hired_date'];
    protected $with=['manager','founder'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manager_id',
        'name',
        'age',
        'gender',
        'email',
        'salary',
        'job_title',
        'hired_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'manager_id' => 'integer',
        'name' => 'string',
        'age' => 'integer',
        'gender' => 'boolean',
        'email' => 'string',
        'salary' => 'integer',
        'job_title' => 'string',
    ];

    /**
     * Get the manger that owns the employees.
     */
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id')->select(['id','name','manager_id']);
    }

    /**
     * The manager that belong to the founder.
     */
    public function founder()
    {
        return $this->belongsToMany(Founder::class, 'employee_founder', 'employee_id', 'founder_id')
            ->withTimestamps()
            ->as('founder');
    }
}
