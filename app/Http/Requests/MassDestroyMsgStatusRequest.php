<?php

namespace App\Http\Requests;

use App\MsgStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMsgStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('msg_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:msg_statuses,id',
        ];

    }
}