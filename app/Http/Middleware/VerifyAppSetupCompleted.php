<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;

class VerifyAppSetupCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $setup_completed = Settings::get('setup_completed', false);

        if (!$setup_completed) {
            return redirect('/setup');
        }

        return $next($request);
    }
}
