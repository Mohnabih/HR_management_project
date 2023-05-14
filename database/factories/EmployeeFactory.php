<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'manager_id' => Employee::factory(),
            'manager_id' => $this->faker->randomElement(Employee::all())['id'],
            'name' =>fake()->name() ,
            'age' =>  mt_rand(20, 60),
            'gender' => fake()->boolean(),
            'email' =>  fake()->unique()->safeEmail(),
            'salary' =>  mt_rand(800, 4000),
            'job_title' => $this->faker->randomElement(Work::all())['job_title'],
        ];
    }
}
