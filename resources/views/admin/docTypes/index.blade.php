@extends('layouts.admin')
@section('content')
@can('doc_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.doc-types.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.docType.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.docType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DocType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.docType.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.docType.fields.doc_type_desc') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docTypes as $key => $docType)
                        <tr data-entry-id="{{ $docType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $docType->id ?? '' }}
                            </td>
                            <td>
                                {{ $docType->doc_type_desc ?? '' }}
                            </td>
                            <td>
                                @can('doc_type_show')
<!--
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.doc-types.show', $docType->id) }}">
                                        11{{ trans('global.view') }}
                                    </a>
-->
                                
                                
                                <form  action="/INOUT/admin/doc-types/showpost"  method="POST" style="display: inline-block;">
                                        <input type="hidden" name="idshowpost" value="{{$docType->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" class="btn btn-xs btn-primary" value="{{ trans('global.view') }}">
                                    </form>       
                                
                                
                                
                                @endcan

                                @can('doc_type_edit')
<!--
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.doc-types.edit', $docType->id) }}">
                                       11 {{ trans('global.edit') }}
                                    </a>
-->
                                
                                
                           <form  action="/INOUT/admin/doc-types/editpost"  method="POST" style="display: inline-block;">
                                        <input type="hidden" name="ideditpost" value="{{$docType->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" class="btn btn-xs btn-info" value="{{ trans('global.edit') }}">
                                    </form>         
                                
                                
                                @endcan

                                @can('doc_type_delete')
                                    <form action="{{ route('admin.doc-types.destroy', $docType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('doc_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.doc-types.massDestroy') }}",
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
  $('.datatable-DocType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection