<?php

namespace App\Console\Commands;

use App\Mail\SendNewMonthGreetingToUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNewMonthGreetings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-new-month-greetings';

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
        $today = now();
        $isFirstDayOfMonth = $today->isStartOfMonth();

        // if (! $isFirstDayOfMonth) return;

        User::all()->each(function (User $user) {
            Log::info("fgghghh");
            Mail::to($user)->send(new SendNewMonthGreetingToUser($user));
        });
    }
}
