<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMsgTypeRequest;
use App\Http\Requests\StoreMsgTypeRequest;
use App\Http\Requests\UpdateMsgTypeRequest;
use App\MsgType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MsgTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('msg_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msgTypes = MsgType::all();

        return view('admin.msgTypes.index', compact('msgTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('msg_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.msgTypes.create');
    }

    public function store(StoreMsgTypeRequest $request)
    {
        $msgType = MsgType::create($request->all());

        return redirect()->route('admin.msg-types.index');

    }
          public function editpost(Request $request)
            
        {
                
             abort_if(Gate::denies('msg_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
           
            $msgType = MsgType::find($request->ideditpost);
                
    return view('admin.msgTypes.edit', compact('msgType'));
                
            }

    public function edit(MsgType $msgType)
    {
        abort_if(Gate::denies('msg_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.msgTypes.edit', compact('msgType'));
    }

    public function update(UpdateMsgTypeRequest $request, MsgType $msgType)
    {
        $msgType->update($request->all());

        return redirect()->route('admin.msg-types.index');

    }
     public function showpost(Request $request)
    {
        abort_if(Gate::denies('msg_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
          $msgType = MsgType::find($request->idshowpost);
    return view('admin.msgTypes.show', compact('msgType'));
         
     }
    public function show(MsgType $msgType)
    {
        abort_if(Gate::denies('msg_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.msgTypes.show', compact('msgType'));
    }

    public function destroy(MsgType $msgType)
    {
        abort_if(Gate::denies('msg_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msgType->delete();

        return back();

    }

    public function massDestroy(MassDestroyMsgTypeRequest $request)
    {
        MsgType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}