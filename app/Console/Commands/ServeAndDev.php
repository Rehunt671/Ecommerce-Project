<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeAndDev extends Command
{
    // Define the command signature and description
    protected $signature = 'run';
    protected $description = 'Run php artisan serve, npm run dev, and php artisan schedule:work';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Run php artisan serve in a separate process
        $this->info('Starting Laravel development server...');
        $serveProcess = popen('php artisan serve', 'r');

        if ($serveProcess) {
            $this->info('Laravel development server started.');

            // Run npm run dev in a separate process
            $this->info('Starting npm run dev...');
            $npmProcess = popen('npm run dev', 'r');

            if ($npmProcess) {
                $this->info('npm run dev started.');

                // Run php artisan schedule:work in a separate process
                $this->info('Starting php artisan schedule:work...');
                $scheduleProcess = popen('php artisan schedule:work', 'r');

                if ($scheduleProcess) {
                    $this->info('php artisan schedule:work started.');
                } else {
                    $this->error('Failed to start php artisan schedule:work.');
                }
            } else {
                $this->error('Failed to start npm run dev.');
            }
        } else {
            $this->error('Failed to start Laravel development server.');
        }

        // Keep the command running and output the process results
        while (!feof($serveProcess) || !feof($npmProcess) || !feof($scheduleProcess)) {
            if (!feof($serveProcess)) {
                echo fgets($serveProcess);
            }
            if (!feof($npmProcess)) {
                echo fgets($npmProcess);
            }
            if (!feof($scheduleProcess)) {
                echo fgets($scheduleProcess);
            }
        }

        pclose($serveProcess);
        pclose($npmProcess);
        pclose($scheduleProcess);
    }
}
