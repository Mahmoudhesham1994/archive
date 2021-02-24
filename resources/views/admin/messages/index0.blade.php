@extends('layouts.admin')
@section('content')
@can('message_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.messages.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.message.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
     <div class="card-header">
         <form method="post" action="/admin/messages/search">
             @csrf
         <div class="row">
   <div class="col-md-4">
 <label>Num</label> <input type="text" name="Num">

</div>
     <div class="col-md-4">
<label>Date From</label> <input name="date_from" type="date">
         

</div>
            <div class="col-md-4">
      
       <label>Date From</label>       <input name="date_to" type="date">
     </div>
   
             
    
     

</div>
 <div class="row">
        <div class="col-md-4">
 <label>Msg Type</label> 
            
<!--            <input type="text" name="msg_type">-->
  <select style="width:148px; height:30px;"  name="msg_type_id" id="msg_type_id" >
                    @foreach($msg_types as $id => $msg_type)
                        <option value="{{ $id }}" {{ old('msg_type_id') == $id ? 'selected' : '' }}>{{ $msg_type }}</option>
                    @endforeach
                </select>
</div>
      <div class="col-md-4">
<label>Msg Title</label> <input type="text" name="msg_title">

</div>
      <div class="col-md-4">
     <input type="submit" value="بحث" style="width:130px;" class="btn btn-primary ">
          </div>
    </div>
 </form>
         
         
        {{ trans('cruds.message.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Message">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.message.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.num') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.msg_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.msg_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.doc_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.msg_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.msg_desc') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.from_contact') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.priority') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.need_replay') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.replay_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.rel_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.sent_to') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $key => $message)
                        <tr data-entry-id="{{ $message->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $message->id ?? '' }}
                            </td>
                            <td>
                                {{ $message->num ?? '' }}
                            </td>
                            <td>
                                {{ $message->msg_date ?? '' }}
                            </td>
                            <td>
                                {{ $message->msg_type->msg_type_desc ?? '' }}
                            </td>
                            <td>
                                {{ $message->doc_type->doc_type_desc ?? '' }}
                            </td>
                            <td>
                                {{ $message->msg_title ?? '' }}
                            </td>
                            <td>
                                {{ $message->msg_desc ?? '' }}
                            </td>
                            <td>
                                {{ $message->from_contact->contact_name ?? '' }}
                            </td>
                            <td>
                                {{ $message->priority->priority_desc ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $message->need_replay ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $message->need_replay ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $message->replay_date ?? '' }}
                            </td>
                            <td>
                                {{ $message->rel_num->num ?? '' }}
                            </td>
                            <td>
                                @foreach($message->sent_tos as $key => $item)
                                    <span class="badge badge-info">{{ $item->contact_name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('message_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.messages.show', $message->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('message_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.messages.edit', $message->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('message_delete')
                                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('message_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.messages.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Message:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection