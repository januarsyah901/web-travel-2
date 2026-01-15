<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleLargePostData
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
        // Check if the request method is POST or PUT
        if ($request->isMethod('post') || $request->isMethod('put')) {
            // Check if POST data is empty (usually means it was too large)
            if (empty($request->all()) && !empty($_SERVER['CONTENT_LENGTH'])) {
                return back()
                    ->with('error', 'Data yang dikirim terlalu besar. Maksimal ukuran file adalah 50MB.')
                    ->withInput();
            }
        }

        return $next($request);
    }
}
