<?php

namespace App\Console\Commands;

use App\Models\Admin\AdminLog;
use Illuminate\Console\Command;

class ClearDatabaseLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {




        $first = AdminLog::first();

        if ($first) {




            $first->delete();
        }


        return 0;
    }
}