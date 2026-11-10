<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ThrottleRequestsException $exception, Request $request): ?RedirectResponse {
            if ($request->routeIs('password.update', 'requestEMailToResetPassword') && ! $request->expectsJson()) {
                $route = $request->routeIs('password.update') ? 'password.reset' : 'password.request';

                return to_route($route)->withErrors(['code' => 'Too many attempts. Please wait one minute and try again.']);
            }

            if ($request->routeIs('login.submit', 'signup.submit') && ! $request->expectsJson()) {
                $seconds = (int) ($exception->getHeaders()['Retry-After'] ?? 60);

                $isSignup = $request->routeIs('signup.submit');
                $action = $isSignup ? 'sign-up' : 'login';

                return to_route($isSignup ? 'signup' : 'login')
                    ->withErrors(['login' => "Too many {$action} attempts. Please try again in {$seconds} seconds."])
                    ->withInput($request->only('name', 'email'));
            }

            return null;
        });
    })->create();
