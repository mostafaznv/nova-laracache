<?php

namespace Mostafaznv\NovaLaraCache\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Mostafaznv\NovaLaraCache\NovaLaraCache;
use Oneduo\NovaFileManager\NovaFileManager;

class Authorize
{
    public function handle(Request $request, Closure $next): Response|JsonResponse
    {
        $tool = collect(Nova::registeredTools())->first([$this, 'matchesTool']);

        return optional($tool)->authorize($request) ? $next($request) : abort(403);
    }

    /**
     * Determine whether this tool belongs to the package.
     *
     * @param Tool $tool
     * @return bool
     */
    public function matchesTool(Tool $tool): bool
    {
        return $tool instanceof NovaLaraCache;
    }
}
