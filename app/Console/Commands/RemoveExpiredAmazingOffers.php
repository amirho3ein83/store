<?php

namespace App\Console\Commands;

use App\Models\AmazingOffer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveExpiredAmazingOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove-expired-amazing-offers';

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
        $amazing_offers = AmazingOffer::where('expiry_date', '<', Carbon::now())->delete();
    }
}
