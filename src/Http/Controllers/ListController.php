<?php

namespace Mostafaznv\NovaLaraCache\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class ListController extends ApiController
{
    public function __invoke()
    {
        $list = $this->list();

        return response()->json([
            'list' => $list
        ]);
    }

    private function list(): array
    {
        $models = $this->models();
        $list = [];

        foreach ($models as $model) {
            $list[] = [
                'model'    => [
                    'name'      => class_basename($model->getMorphClass()),
                    'namespace' => $model->getMorphClass(),
                ],
                'table'    => $model->getTable(),
                'entities' => $this->entities($model)
            ];
        }

        return $list;
    }

    private function entities(Model $model): array
    {
        $entities = [];
        $cacheEntities = Arr::sort($model->cacheEntities(), function ($entity) {
            return $entity->name;
        });

        foreach ($cacheEntities as $entity) {
            $entities[] = $this->entityToArray($entity, $model->getMorphClass());
        }

        return $entities;
    }
}
