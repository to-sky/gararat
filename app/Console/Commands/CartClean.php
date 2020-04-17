<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CartClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans cart table of entries which more than year';

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
        return DB::table('cart')
            ->whereDate('updated_at', '<=', Carbon::now()->sub(1, 'year')->toDateTimeString())
            ->delete();
    }
}
