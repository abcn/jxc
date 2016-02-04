<?php
/**
 * Created by PhpStorm.
 * User: zhouhaotong
 * Date: 16/2/5
 * Time: 上午4:27
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MarketAuth
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route('market.login'));
            }
        }

        return $next($request);
    }
}