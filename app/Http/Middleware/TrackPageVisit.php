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
        if (!$request->is('admin*') && !$request->is('livewire*') && !$request->is('api*') && !$request->is('_debugbar*') && $request->method() === 'GET') {
            $sessionKey = 'last_counted_view_at_' . md5($request->url());
            $lastCountedTime = $request->session()->get($sessionKey);
            
            // Check if 1 hour (3600 seconds) has passed since the last counted view in this browser session FOR THIS URL
            if (!$lastCountedTime || (now()->timestamp - $lastCountedTime) >= 3600) {
                $today = now()->format('Y-m-d');
                
                \App\Models\PageVisit::create([
                    'url' => $request->url(),
                    'ip_address' => $request->ip(),
                    'visited_date' => $today,
                    'user_agent' => $request->userAgent(),
                ]);
                
                // Save the current timestamp to the session for this URL
                $request->session()->put($sessionKey, now()->timestamp);
            }
        }

        return $next($request);
    }
}
