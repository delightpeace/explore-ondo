<?php

namespace App\Console\Commands;

use App\Mail\SubscriberGreeting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendUserGreetings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-user-greetings {occasion : monthly, festive, or new-year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue an occasion greeting for newsletter subscribers';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $occasion = (string) $this->argument('occasion');
        $greeting = config('greetings.'.$occasion);

        if (! is_array($greeting) || ! isset($greeting['subject'], $greeting['title'], $greeting['message'], $greeting['button'])) {
            $this->error('Choose monthly, festive, or new-year.');

            return self::FAILURE;
        }

        $queued = 0;
        DB::table('newsletter_subscribers')->select(['id', 'email'])->orderBy('id')->chunkById(100, function ($subscribers) use ($greeting, &$queued): void {
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->queue(new SubscriberGreeting($subscriber->email, $greeting));
                $queued++;
            }
        });

        $this->info("Queued {$queued} {$occasion} greeting emails for newsletter subscribers.");

        return self::SUCCESS;
    }
}
