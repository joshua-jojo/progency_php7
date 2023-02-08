<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Agen
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
        $agen = auth()->user()->load('jawaban');
        $jawaban = $agen->jawaban->count();
        if ($jawaban) {
            return $next($request);
        }
        return redirect()->route('pertanyaan.agen.index');
    }
}
