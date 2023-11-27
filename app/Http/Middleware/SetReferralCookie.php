<?php

namespace App\Http\Middleware;

use Closure;
use App\Referral;

class SetReferralCookie
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
        if ($referral = $request->referral($request->referral)) {
            cookie()->queue(cookie()->forever('referral', $referral->token));
        }

        return $next($request);
    }
}
