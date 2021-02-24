@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.msgStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.msg-statuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="msg_status_desc">{{ trans('cruds.msgStatus.fields.msg_status_desc') }}</label>
                <input class="form-control {{ $errors->has('msg_status_desc') ? 'is-invalid' : '' }}" type="text" name="msg_status_desc" id="msg_status_desc" value="{{ old('msg_status_desc', '') }}" required>
                @if($errors->has('msg_status_desc'))
                    <span class="text-danger">{{ $errors->first('msg_status_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.msgStatus.fields.msg_status_desc_helper') }}</span>
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