<?php

namespace Mostafaznv\NovaLaraCache\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class ListController extends ApiController
{
    public function __invoke()
    {
        return response()->json([
            'models' => $this->listModels(),
            'groups' => $this->listGroups(),
        ]);
    }

    private function listModels(): array
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

    private function listGroups(): array
    {
        $groups = config('laracache.groups');
        $list = [];

        foreach ($groups as $slug => $group) {
            $models = [];

            foreach ($group as $model) {
                $m = $model['model'];

                if (method_exists($m, 'cacheEntities')) {
                    $m = $this->model($m);

                    $models[] = [
                        'model'    => [
                            'name'      => class_basename($m->getMorphClass()),
                            'namespace' => $m->getMorphClass(),
                        ],
                        'table'    => $m->getTable(),
                        'entities' => $model['entities']
                    ];
                }
            }

            if (count($models)) {
                $list[] = [
                    'group'  => [
                        'slug' => $slug,
                        'name' => Str::of($slug)->slug(' ')->title(),
                    ],
                    'models' => $models
                ];
            }
        }

        return $list;
    }

    private function entities(Model $model): array
    {
        $entities = [];
        $cacheEntities = Arr::sort($model->cacheEntities(), function($entity) {
            return $entity->name;
        });

        foreach ($cacheEntities as $entity) {
            $entities[] = $this->entityToArray($entity, $model->getMorphClass());
        }

        return $entities;
    }
}
