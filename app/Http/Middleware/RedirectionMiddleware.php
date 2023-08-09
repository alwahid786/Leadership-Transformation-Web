<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $lastVisitedRoute = $user->page_number;

            if ($lastVisitedRoute != null) {
                dd('coming');
                // Define a mapping of route names to actual URLs or controller methods
                $routeMapping = [
                    'cover' => '/slide/1',
                    'slide1' => '/slide/2',
                    'slide2' => '/slide/3',
                    'slide3' => '/slide/4',
                    'slide4' => '/slide/5',
                    'slide5' => '/slide/6',
                    'slide6' => '/slide/7',
                ];

                if (isset($routeMapping[$lastVisitedRoute])) {
                    return redirect($routeMapping[$lastVisitedRoute]);
                }
            }
            return redirect('/cover');
        }

        return $next($request);
    }
}
