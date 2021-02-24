<?php

namespace App\Http\Requests;

use App\DocType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDocTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('doc_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'doc_type_desc' => [
                'required'],
        ];

    }
}