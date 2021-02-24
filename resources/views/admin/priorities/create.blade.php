@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.priority.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.priorities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="priority_desc">{{ trans('cruds.priority.fields.priority_desc') }}</label>
                <input class="form-control {{ $errors->has('priority_desc') ? 'is-invalid' : '' }}" type="text" name="priority_desc" id="priority_desc" value="{{ old('priority_desc', '') }}" required>
                @if($errors->has('priority_desc'))
                    <span class="text-danger">{{ $errors->first('priority_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.priority.fields.priority_desc_helper') }}</span>
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