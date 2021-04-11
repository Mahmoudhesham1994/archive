@extends('layouts.admin')
@section('content')
@can('contact_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.contacts.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.contact.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contact.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Contact">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.contact.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.contact.fields.contact_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.contact.fields.contact_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.contact.fields.contact_phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.contact.fields.is_external') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $key => $contact)
                        <tr data-entry-id="{{ $contact->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $contact->id ?? '' }}
                            </td>
                            <td>
                                {{ $contact->contact_name ?? '' }}
                            </td>
                            <td>
                                {{ $contact->contact_email ?? '' }}
                            </td>
                            <td>
                                {{ $contact->contact_phone ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $contact->is_external ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $contact->is_external ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('contact_show')
<!--
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.contacts.show', $contact->id) }}">
                                       00 {{ trans('global.view') }}
                                    </a>
-->
                                
                                      <form  action="/INOUT/admin/contacts/showpost"  method="POST" style="display: inline-block;">
                                        <input type="hidden" name="idshowpost" value="{{$contact->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" class="btn btn-xs btn-primary" value="{{ trans('global.view') }}">
                                    </form>  
                                
                                
                                @endcan

                                @can('contact_edit')
<!--
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.contacts.edit', $contact->id) }}">
                                   00     {{ trans('global.edit') }}
                                    </a>
-->
                                
                                
                                
                                 <form  action="/INOUT/admin/contacts/editpost"  method="POST" style="display: inline-block;">
                                        <input type="hidden" name="ideditpost" value="{{$contact->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" class="btn btn-xs btn-info" value="{{ trans('global.edit') }}">
                                    </form>
                                @endcan

                                @can('contact_delete')
                                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('contact_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contacts.massDestroy') }}",
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
  $('.datatable-Contact:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection