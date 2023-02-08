<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role = auth()->user()->role;
        switch ($role) {
            case 'developer':
                return redirect()->route('dashboard.developer.index');
                break;

            case 'agen':
                return redirect()->route('dashboard.agen.index');
                break;

            case 'admin':
                return redirect()->route('dashboard.admin.index');
                break;

            case 'super admin':
                return redirect()->route('dashboard.superadmin.index');
                break;

            default:
                return $next($request);
                break;
        }
    }
}
