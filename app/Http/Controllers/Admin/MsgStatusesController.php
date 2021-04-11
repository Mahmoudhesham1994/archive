<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMsgStatusRequest;
use App\Http\Requests\StoreMsgStatusRequest;
use App\Http\Requests\UpdateMsgStatusRequest;
use App\MsgStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MsgStatusesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('msg_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msgStatuses = MsgStatus::all();

        return view('admin.msgStatuses.index', compact('msgStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('msg_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.msgStatuses.create');
    }

    public function store(StoreMsgStatusRequest $request)
    {
        $msgStatus = MsgStatus::create($request->all());

        return redirect()->route('admin.msg-statuses.index');

    }
    
           public function editpost(Request $request)
            
        {
                
           abort_if(Gate::denies('msg_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
           
            $msgStatus = MsgStatus::find($request->ideditpost);
                
    return view('admin.msgStatuses.edit', compact('msgStatus'));
                
            }

    public function edit(MsgStatus $msgStatus)
    {
        abort_if(Gate::denies('msg_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.msgStatuses.edit', compact('msgStatus'));
    }

    public function update(UpdateMsgStatusRequest $request, MsgStatus $msgStatus)
    {
        $msgStatus->update($request->all());

        return redirect()->route('admin.msg-statuses.index');

    }
     public function showpost(Request $request)
    {
         abort_if(Gate::denies('msg_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
          $msgStatus = MsgStatus::find($request->idshowpost);
     return view('admin.msgStatuses.show', compact('msgStatus'));
     }
    public function show(MsgStatus $msgStatus)
    {
        abort_if(Gate::denies('msg_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.msgStatuses.show', compact('msgStatus'));
    }

    public function destroy(MsgStatus $msgStatus)
    {
        abort_if(Gate::denies('msg_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msgStatus->delete();

        return back();

    }

    public function massDestroy(MassDestroyMsgStatusRequest $request)
    {
        MsgStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}