<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tracking for admin panel, livewire internal requests, and API
        if (!$request->is('admin*') && !$request->is('livewire*') && !$request->is('api*') && !$request->is('_debugbar*') && $request->method() === 'GET') {
            $today = now()->format('Y-m-d');
            
            // Log every page visit
            \App\Models\PageVisit::create([
                'url' => $request->url(),
                'ip_address' => $request->ip(),
                'visited_date' => $today,
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
