<?php

namespace Mostafaznv\NovaLaraCache;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Tool;

class NovaLaraCache extends Tool
{
    public function menu(Request $request): mixed
    {
        return MenuSection::make(__('nova-laracache::ui.nova-laracache.section-name'))
            ->path('/laracache')
            ->icon('lightning-bolt');
    }
}
