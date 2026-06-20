<?php

namespace App\Console\Commands;

use App\Models\datasiswa;
use Illuminate\Console\Command;

class ResetTelatHourly extends Command
{
    protected $signature = 'reset:telat-hourly';
    protected $description = 'Reset Telat counter for all students';

    public function handle()
    {
        datasiswa::query()->update(['Telat' => 0]);
        $this->info('Telat counter reset successfully.');
    }
}
