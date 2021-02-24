<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMsgStatusRequest;
use App\Http\Requests\UpdateMsgStatusRequest;
use App\Http\Resources\Admin\MsgStatusResource;
use App\MsgStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MsgStatusesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('msg_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MsgStatusResource(MsgStatus::all());

    }

    public function store(StoreMsgStatusRequest $request)
    {
        $msgStatus = MsgStatus::create($request->all());

        return (new MsgStatusResource($msgStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(MsgStatus $msgStatus)
    {
        abort_if(Gate::denies('msg_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MsgStatusResource($msgStatus);

    }

    public function update(UpdateMsgStatusRequest $request, MsgStatus $msgStatus)
    {
        $msgStatus->update($request->all());

        return (new MsgStatusResource($msgStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(MsgStatus $msgStatus)
    {
        abort_if(Gate::denies('msg_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msgStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}