<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Queue\Worker;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $works = [
            'CEO',
            'CTO',
            'Product Manager',
            'Team Lead', 'Software Engineer',
            'Software Developer',
            'Software Architect'
        ];
        foreach ($works as $work) {
            Work::create([
                'job_title' => $work
            ]);
        }
    }
}
