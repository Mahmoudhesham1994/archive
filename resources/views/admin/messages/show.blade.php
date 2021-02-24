@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.message.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.id') }}
                        </th>
                        <td>
                            {{ $message->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.num') }}
                        </th>
                        <td>
                            {{ $message->num }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.msg_date') }}
                        </th>
                        <td>
                            {{ $message->msg_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.msg_type') }}
                        </th>
                        <td>
                            {{ $message->msg_type->msg_type_desc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.doc_type') }}
                        </th>
                        <td>
                            {{ $message->doc_type->doc_type_desc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.msg_title') }}
                        </th>
                        <td>
                            {{ $message->msg_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.msg_subject') }}
                        </th>
                        <td>
                            {{ $message->msg_subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.msg_desc') }}
                        </th>
                        <td>
                            {{ $message->msg_desc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.from_contact') }}
                        </th>
                        <td>
                            {{ $message->from_contact->contact_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.priority') }}
                        </th>
                        <td>
                            {{ $message->priority->priority_desc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.need_replay') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $message->need_replay ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.replay_date') }}
                        </th>
                        <td>
                            {{ $message->replay_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.rel_num') }}
                        </th>
                        <td>
                            {{ $message->rel_num->num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.sent_to') }}
                        </th>
                        <td>
                            @foreach($message->sent_tos as $key => $sent_to)
                                <span class="label label-info">{{ $sent_to->contact_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
<!--
                        <th>
                            {{ trans('cruds.message.fields.forward_to') }}
                        </th>
-->
                        {{--<td>
                            {{ $message->forward_to->contact_name ?? '' }}
                        </td>--}}
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.message_doc') }}
                        </th>
                        <td>
                            @foreach($message->message_doc as $key => $media)
<!--                                <a href="{{ $media->getUrl() }}" target="_blank">-->
                             <?php //dd($message->message_doc); ?>
           <a href="http://172.23.101.27/INOUT/public/messages/{{$media->file_name}}" target="_blank">

<!--                                <a href="{{ substr_replace($media->getUrl(),":8000",16,0) }}" target="_blank">-->
                                    {{ trans('global.view_file') }}
<!--
                                    {{ $media->getUrl() }}
                                    <br>
                                    {{ substr_replace($media->getUrl(),":8000",16,0)}}
-->
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection