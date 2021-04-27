@extends('layouts.admin')
@section('content')
@can('msg_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.msg-types.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.msgType.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.msgType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MsgType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.msgType.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.msgType.fields.msg_type_desc') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($msgTypes as $key => $msgType)
                        <tr data-entry-id="{{ $msgType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $msgType->id ?? '' }}
                            </td>
                            <td>
                                {{ $msgType->msg_type_desc ?? '' }}
                            </td>
                            <td>
                                @can('msg_type_show')
<!--
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.msg-types.show', $msgType->id) }}">
                                     00   {{ trans('global.view') }}
                                    </a>
-->
                                
                                
                        <form  action="{{asset('/admin/msg-types/showpost') }}"  method="POST" style="display: inline-block;">
<!--                                       <form  action="/INOUT/admin/msg-types/showpost"  method="POST" style="display: inline-block;">-->
                                        <input type="hidden" name="idshowpost" value="{{$msgType->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" class="btn btn-xs btn-primary" value="{{ trans('global.view') }}">
                                    </form>   
                                @endcan

                                @can('msg_type_edit')
<!--
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.msg-types.edit', $msgType->id) }}">
                                      00  {{ trans('global.edit') }}
                                    </a>
-->
                                
                                
                                
                                   <form  action="{{asset('/admin/msg-types/editpost') }}"  method="POST" style="display: inline-block;">
<!--                                   <form  action="/INOUT/admin/msg-types/editpost"  method="POST" style="display: inline-block;">-->
                                        <input type="hidden" name="ideditpost" value="{{$msgType->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" class="btn btn-xs btn-info" value="{{ trans('global.edit') }}">
                                    </form>
                                @endcan

                                @can('msg_type_delete')
                                    <form action="{{ route('admin.msg-types.destroy', $msgType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('msg_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.msg-types.massDestroy') }}",
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
  $('.datatable-MsgType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection