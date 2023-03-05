<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class VerifyEmail
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle($request, Closure $next, $redirectToRoute = null)
  {
    if (!$request->user() || ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail())) {
      return $request->expectsJson()
        ? abort(403, 'Your email address is not verified.')
        : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
    }

    return $next($request);
  }
}
