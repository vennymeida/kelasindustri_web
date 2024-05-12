<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
class UpdateLokerStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:lokerstatus';
    protected $description = 'Update loker status based on tgl_tutup';
    

    /**
     * The console command description.
     *
     * @var string
     */
 

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->format('Y-m-d');
        $affectedRows = DB::table('lokers')
                          ->where('status', 'dibuka')
                          ->where('tgl_tutup', '<=', $today)
                          ->update(['status' => 'ditutup']);
    
        $this->info("Updated $affectedRows loker statuses at " . Carbon::now());
    }
    
}
