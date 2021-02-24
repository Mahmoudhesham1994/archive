<?php

namespace App\Http\Requests;

use App\Message;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateMessageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'num'         => [
                'max:15',
                'required'],
            'msg_date'    => [
                'required',
                'date_format:' . config('panel.date_format')],
            'msg_type_id' => [
                'required',
                'integer'],
            'msg_title'   => [
                'required'],
            'replay_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'sent_tos.*'  => [
                'integer'],
            'sent_tos'    => [
                'array'],
        ];

    }
}