<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminEmails = config('app.admin_emails');
        $authenticatedUser = Auth::user();

        if ($authenticatedUser && ! in_array($authenticatedUser->email, $adminEmails)) {
            return redirect()->route('login')->withErrors(['email' => 'You do not have access to this resource.']);
        }

        return $next($request);
    }
}
