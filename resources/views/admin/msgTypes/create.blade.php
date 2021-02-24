@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.msgType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.msg-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="msg_type_desc">{{ trans('cruds.msgType.fields.msg_type_desc') }}</label>
                <input class="form-control {{ $errors->has('msg_type_desc') ? 'is-invalid' : '' }}" type="text" name="msg_type_desc" id="msg_type_desc" value="{{ old('msg_type_desc', '') }}" required>
                @if($errors->has('msg_type_desc'))
                    <span class="text-danger">{{ $errors->first('msg_type_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.msgType.fields.msg_type_desc_helper') }}</span>
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