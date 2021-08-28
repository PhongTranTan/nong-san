<?php

namespace App\Console\Commands;

use App\Models\Career;
use App\Models\System;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateStatusOfJobConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_job_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Update status of the Job Opportunity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date_now = Carbon::now()->toDateString();

        // From publish to expired
        Career::where('status', 'publish')
            ->where('expired_date', '<=', $date_now)
            ->update([
                'status' => 'expired'
            ]);

        $day = (int)System::content('day_update_job_status', 30); // Lấy số ngày để cập nhất trong hệ thống

        $date_to_update = Carbon::now()->subDays($day);

        // From publish to expired
        Career::where('status', 'expired')
            ->where('expired_date', '<=', $date_to_update)
            ->update([
                'status' => 'closed'
            ]);

        echo 'Done';
    }
}
