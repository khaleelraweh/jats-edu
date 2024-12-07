<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use App\Models\PageVisit;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        $ipAddress = $request->ip();
        $path = rawurldecode($request->path()); // Decode the URL to handle Arabic characters
        $today = now()->toDateString();

        // Log visitor details
        Visitor::updateOrCreate(
            ['ip_address' => $ipAddress, 'visited_at' => $today],
            ['last_page' => $path]
        );

        // Log page visit
        PageVisit::create([
            'page' => $path,
            'ip_address' => $ipAddress,
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
