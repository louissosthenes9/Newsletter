<?php

namespace App\Jobs;

use App\Mail\MailTemplate;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $subscribers;
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        
        $subscribers = Subscriber::all();

        $mailData = [
            'title' => 'Mail from Bigbee',
            'body' => 'Thank you for subscribing'
        ];

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new MailTemplate($mailData));
        }
    }
}
