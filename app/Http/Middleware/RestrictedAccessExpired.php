<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class RestrictedAccessExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd($request->id);

        $animalprincipal = DB::table('sales')->where('nickname', $request->id)->first();
        if ( $animalprincipal->disabled == 0 && $animalprincipal->user_id != auth()->user()->user_id) {
            return $next($request);
        }
        else if ( $animalprincipal->disabled == 1 && $animalprincipal->user_id == auth()->user()->user_id ) {
            return $next($request);
        }
        else if ( $animalprincipal->disabled == 0 && $animalprincipal->user_id == auth()->user()->user_id ) {
            return $next($request);
        }

        //return response()->json($animalprincipal->disabled);
        return redirect()->route("home");
    }
}
