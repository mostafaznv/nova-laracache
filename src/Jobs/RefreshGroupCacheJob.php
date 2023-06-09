<?php

namespace Mostafaznv\NovaLaraCache\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Mostafaznv\LaraCache\Commands\UpdateGroupCacheCommand;

class RefreshGroupCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $group) {}


    public function handle(): void
    {
        Artisan::call(UpdateGroupCacheCommand::class, [
            'group' => $this->group
        ]);
    }
}
