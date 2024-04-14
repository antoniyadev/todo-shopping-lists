<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\ShoppingList;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendScheduledLists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-lists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $lists = ShoppingList::where('is_published', true)->where('send_date', $now->toDateString())->get();
        $this->info("Sending {$lists->count()} lists");
        foreach ($lists as $list) {
            SendEmail::dispatch($list);
        }
    }
}
