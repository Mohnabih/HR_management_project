<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveLogsFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lf:wipe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove log files.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file_path = storage_path("logs/Hr_activites.log");
        if (File::exists($file_path)) {
            File::delete($file_path);
            $this->info( "logs file removed successfully");
        } else $this->error( "logs file not founded");
    }
}
