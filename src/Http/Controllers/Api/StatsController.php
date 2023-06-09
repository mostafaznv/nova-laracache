<?php

namespace Mostafaznv\NovaLaraCache\Http\Controllers\Api;


class StatsController extends ApiController
{
    public function __invoke()
    {
        $models = $this->models();

        return response()->json([
            'usage'    => count($models),
            'entities' => $this->totalEntities($models)
        ]);
    }

    private function totalEntities(array $models): int
    {
        $entities = 0;

        foreach ($models as $model) {
            $entities += count($model->cacheEntities());
        }

        return $entities;
    }
}
