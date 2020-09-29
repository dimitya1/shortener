<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLinkAuthorShow
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
        $link = $request->link;
        if ($request->user()->cannot('view', $link)) {
            return redirect()
                ->route('links.index')
                ->withErrors(['not allowed' => 'You cannot view this link info!']);
        }
        return $next($request);
    }
}
