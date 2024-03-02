<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CandidateMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle( Request $request, Closure $next ): Response {
        if ( $request->user() && $request->user()->role !== 'candidate' ) {
            return redirect()->back()->with( 'error', 'Only candidates can apply.' );
        }
        return $next( $request );
    }
}