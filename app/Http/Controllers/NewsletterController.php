<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberGreeting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    public function index(): View
    {
        return view('newsletter.subscribers', [
            'subscribers' => DB::table('newsletter_subscribers')
                ->orderByDesc('subscribed_at')
                ->paginate(25),
        ]);
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $inserted = DB::table('newsletter_subscribers')->insertOrIgnore([
            'email' => $validated['email'],
            'subscribed_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($inserted === 1) {
            Mail::to($validated['email'])->queue(new SubscriberGreeting($validated['email'], config('greetings.welcome')));
        }

        return redirect()->to(route('home') . '#newsletter')->with(
            'newsletter_status',
            $inserted === 1
                ? 'Thanks for signing up. We’ll keep you posted with Explore Ondo updates.'
                : 'That email is already signed up for Explore Ondo updates.'
        );
    }
}
