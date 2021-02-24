<?php

namespace App\Http\Requests;

use App\MsgStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateMsgStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('msg_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'msg_status_desc' => [
                'required'],
        ];

    }
}