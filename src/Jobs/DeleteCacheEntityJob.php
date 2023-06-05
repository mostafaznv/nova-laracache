<?php

namespace Mostafaznv\NovaLaraCache\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Mostafaznv\LaraCache\Commands\DeleteCacheCommand;

class DeleteCacheEntityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $model,
        public array  $entities = [],
    ) {}


    public function handle(): void
    {
        Artisan::call(DeleteCacheCommand::class, [
            '--model'  => [
                $this->model
            ],
            '--entity' => $this->entities
        ]);
    }
}
