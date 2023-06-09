<?php

namespace Mostafaznv\NovaLaraCache\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\NovaLaraCache\Http\Requests\OperateCacheEntityRequest;
use Mostafaznv\NovaLaraCache\Http\Requests\ViewCacheEntityRequest;
use Mostafaznv\NovaLaraCache\Jobs\DeleteCacheEntityJob;
use Mostafaznv\NovaLaraCache\Jobs\RefreshCacheEntityJob;


class EntityController extends ApiController
{
    public function show(ViewCacheEntityRequest $request)
    {
        $model = $this->model($request->query('model'));
        $entity = $this->entity($model, $request);

        return response()->json([
            'model'  => [
                'name'      => class_basename($model->getMorphClass()),
                'namespace' => $model->getMorphClass(),
            ],
            'table'  => $model->getTable(),
            'entity' => $this->entityToArray($entity, $model->getMorphClass(), true)
        ]);
    }

    public function refresh(OperateCacheEntityRequest $request)
    {
        RefreshCacheEntityJob::dispatch(
            $request->post('model'),
            $request->post('entities')
        );

        return response()->json();
    }

    public function delete(OperateCacheEntityRequest $request)
    {
        DeleteCacheEntityJob::dispatch(
            $request->post('model'),
            $request->post('entities')
        );

        return response()->json();
    }

    private function entity(Model $model, Request $request): ?CacheEntity
    {
        $name = $request->query('entity');

        foreach ($model->cacheEntities() as $entity) {
            if ($entity->name == $name) {
                return $entity;
            }
        }

        return null;
    }
}
