<?php

namespace App\Http\Middleware;

use App\Models\Application;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApplicationOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $application = Application::find($request->route('id'));

        if (!$application || $application->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}
