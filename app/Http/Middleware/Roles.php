<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Roles
{

  private function checkRole($role)
  {
      switch ($role) {
        case 'user':
          return Auth::user()->hasRole('user');
        case 'manager':
            return Auth::user()->hasRole('manager');
        case 'admin':
            return Auth::user()->hasRole('admin');
      }

    return false;
  }

  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, ...$roles)
  {
    if (!Auth::user()) {
      return redirect('/');
    }
    foreach ($roles as $role) {
      if ($this->checkRole($role)) {
        //At least one role passes
        return $next($request);
      }
    }
    return redirect('/');
  }
}
