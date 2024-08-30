<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Request as TailorRequest;

class CheckHireRequestTiming
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $customerId = $request->customer_id;
        $tailorId = $request->tailor_id;

        if (!TailorRequest::canSendHireRequest($customerId, $tailorId)) {
            return response()->json(['message' => 'Try again after 30 minutes.'], 429);
        }
        // 429 = Too many requests
        return $next($request);
    }
}
