<?php

namespace App\Jobs;

use App\Models\ShoppingList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public ShoppingList $list)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $listUrl = config('app.url') . "/shopping-lists/" . $this->list->id;

        $emailContent = "Hello, you received a new shopping list. View it here: {$listUrl}";

        Mail::raw($emailContent, function ($message) {
            $message->from('test@example.com', config('app.name'))
                ->to($this->list->recipient)
                ->subject("You have a new list from {$this->list->user->email}");
        });
    }
}
