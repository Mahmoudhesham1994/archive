@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contact.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contacts.update", [$contact->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="contact_name">{{ trans('cruds.contact.fields.contact_name') }}</label>
                <input class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $contact->contact_name) }}" required>
                @if($errors->has('contact_name'))
                    <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_email">{{ trans('cruds.contact.fields.contact_email') }}</label>
                <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $contact->contact_email) }}">
                @if($errors->has('contact_email'))
                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.contact_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_phone">{{ trans('cruds.contact.fields.contact_phone') }}</label>
                <input class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $contact->contact_phone) }}">
                @if($errors->has('contact_phone'))
                    <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.contact_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_external') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_external" value="0">
                       <label class="form-check-label" for="is_external">{{ trans('cruds.contact.fields.is_external') }}</label>

                    <input class="form-check-input" type="checkbox" name="is_external" id="is_external" value="1" {{ $contact->is_external || old('is_external', 0) === 1 ? 'checked' : '' }}>
                </div>
                @if($errors->has('is_external'))
                    <span class="text-danger">{{ $errors->first('is_external') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.is_external_helper') }}</span>
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