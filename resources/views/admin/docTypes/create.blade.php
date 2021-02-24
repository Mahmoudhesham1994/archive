@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.docType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doc-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="doc_type_desc">{{ trans('cruds.docType.fields.doc_type_desc') }}</label>
                <input class="form-control {{ $errors->has('doc_type_desc') ? 'is-invalid' : '' }}" type="text" name="doc_type_desc" id="doc_type_desc" value="{{ old('doc_type_desc', '') }}" required>
                @if($errors->has('doc_type_desc'))
                    <span class="text-danger">{{ $errors->first('doc_type_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docType.fields.doc_type_desc_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection