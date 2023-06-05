<?php

namespace Mostafaznv\NovaLaraCache\Http\Controllers;

use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaLaraCacheController extends Controller
{
    public function home(NovaRequest $request)
    {
        return Inertia::render('NovaLaraCache', [
            'config' => [],
        ]);
    }
}
