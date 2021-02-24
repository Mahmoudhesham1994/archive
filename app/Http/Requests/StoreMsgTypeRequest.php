<?php

namespace App\Http\Requests;

use App\MsgType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreMsgTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('msg_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'msg_type_desc' => [
                'required'],
        ];

    }
}