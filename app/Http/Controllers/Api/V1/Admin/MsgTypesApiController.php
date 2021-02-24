<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMsgTypeRequest;
use App\Http\Requests\UpdateMsgTypeRequest;
use App\Http\Resources\Admin\MsgTypeResource;
use App\MsgType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MsgTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('msg_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MsgTypeResource(MsgType::all());

    }

    public function store(StoreMsgTypeRequest $request)
    {
        $msgType = MsgType::create($request->all());

        return (new MsgTypeResource($msgType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(MsgType $msgType)
    {
        abort_if(Gate::denies('msg_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MsgTypeResource($msgType);

    }

    public function update(UpdateMsgTypeRequest $request, MsgType $msgType)
    {
        $msgType->update($request->all());

        return (new MsgTypeResource($msgType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(MsgType $msgType)
    {
        abort_if(Gate::denies('msg_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msgType->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}