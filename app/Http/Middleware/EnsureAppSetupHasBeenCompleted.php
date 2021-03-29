<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;

class EnsureAppSetupHasBeenCompleted
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
        $setup_completed = Settings::where('name', 'setup_completed')->first();

        if (boolval($setup_completed->value)) {
            return $next($request);
        }

        return redirect('/app-setup');
    }
}
