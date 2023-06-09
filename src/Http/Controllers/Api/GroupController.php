<?php

namespace Mostafaznv\NovaLaraCache\Http\Controllers\Api;

use Mostafaznv\NovaLaraCache\Http\Requests\OperateGroupRequest;
use Mostafaznv\NovaLaraCache\Jobs\DeleteGroupCacheJob;
use Mostafaznv\NovaLaraCache\Jobs\RefreshGroupCacheJob;


class GroupController extends ApiController
{
    public function refresh(OperateGroupRequest $request)
    {
        RefreshGroupCacheJob::dispatch(
            $request->post('group')
        );

        return response()->json();
    }

    public function delete(OperateGroupRequest $request)
    {
        DeleteGroupCacheJob::dispatch(
            $request->post('group')
        );

        return response()->json();
    }
}
