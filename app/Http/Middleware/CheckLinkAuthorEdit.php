<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;

class CheckLinkAuthorEdit
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $link = $request->link;
        if ($request->user()->cannot('update', $link)) {
            return redirect()
                ->route('links.index')
                ->withErrors(['not allowed' => 'You cannot edit this link!']);
        }
        return $next($request);
    }
}
