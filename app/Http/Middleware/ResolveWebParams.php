<?php

namespace App\Http\Middleware;

use App\Models\Data;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class ResolveWebParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $parameters = $request->route()->parameters();

        if (Arr::has($parameters, 'data')) {
            $modal = Data::findOrFail($parameters['data']);

            $request->route()->setParameter('data', $modal);
        }

        return $next($request);
    }
}
