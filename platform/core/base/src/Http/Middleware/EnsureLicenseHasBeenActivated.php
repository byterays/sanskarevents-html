<?php

namespace Botble\Base\Http\Middleware;

use Botble\Base\Supports\Core;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureLicenseHasBeenActivated
{
    public function __construct(private Core $core)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        if (
            ! is_in_admin(true)
            || Auth::guest()
            || $this->core->isSkippedLicenseReminder()
            || $this->core->verifyLicense(true)
        ) {
            return $next($request);
        }

        return $next($request);
    }
}
