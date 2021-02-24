<?php

namespace App\Http\Requests;

use App\Archive;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreArchiveRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('archive_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'arc_date'  => [
                'required',
                'date_format:' . config('panel.date_format')],
            'arc_title' => [
                'required'],
        ];

    }
}