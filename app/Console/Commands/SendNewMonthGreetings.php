<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
    protected $description = 'Queue personalized new-month greetings for registered users';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        return Artisan::call('app:send-user-greetings', ['occasion' => 'monthly']);
    }
}
