@extends('layouts.admin')
@section('content')
@can('archive_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.archives.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.archive.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        
         <form method="POST" action="{{asset('/admin/archives/search') }}">
<!--         <form method="POST" action="/INOUT/admin/archives/search">-->
        @csrf
     <div class="container-fluid ">
        <div class="row">
            <div class="col-4">
            <div class="form-group">
                <label   for="date_to">{{ trans('cruds.archive.fields.arc_date') }}</label>
                <input dir="ltr" class="form-control  {{ $errors->has('arc_date') ? 'is-invalid' : '' }}" type="date" name="date_from" id="date_from"  value=" "  >
<!--                <input dir="ltr" class="form-control date {{ $errors->has('arc_date') ? 'is-invalid' : '' }}" type="text" name="date_from" id="date_from"  value=" "  >-->
                @if($errors->has('date_to'))
                    <span class="text-danger">{{ $errors->first('arc_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_date_helper') }}</span>
            </div>
                
            </div>

            <div class="col-4">
            {{--<div class="form-group">
                <label   for="msg_title">{{ trans('cruds.archive.fields.arc_title') }}</label>
                <input dir="ltr"class="form-control {{ $errors->has('arc_title') ? 'is-invalid' : '' }}" type="text" name="arc_title" id="arc_title" value=" " >
                @if($errors->has('arc_title'))
                    <span class="text-danger">{{ $errors->first('arc_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_title_helper') }}</span>
            </div>--}}
                <div class="form-group">
                <label   for="date_to">{{ trans('cruds.archive.fields.arc_date') }}</label>
                <input    class="form-control  {{ $errors->has('arc_date') ? 'is-invalid' : '' }}" type="date" name="date_to" id="date_to"  value=" "  >
<!--                <input    class="form-control date {{ $errors->has('arc_date') ? 'is-invalid' : '' }}" type="text" name="date_to" id="date_to"  value=" "  >-->
                @if($errors->has('date_to'))
                    <span class="text-danger">{{ $errors->first('arc_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_date_helper') }}</span>
            </div>
          

            </div>
            <div class="col-4"> 
                <div class="form-group">
                <label   for="msg_title">{{ trans('cruds.archive.fields.arc_title') }}</label>
                <input class="form-control {{ $errors->has('arc_title') ? 'is-invalid' : '' }}" type="text" name="arc_title" id="arc_title" value=" " >
                @if($errors->has('arc_title'))
                    <span class="text-danger">{{ $errors->first('arc_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_title_helper') }}</span>
            </div>
          
</div>
        </div>
       {{-- <div class="w-100"></div> --}}
        <div class="row">
            <div class="col-4"> 
                <div class="form-group">
                <label   for="msg_type_id">{{ trans('cruds.archive.fields.doc_type') }}</label>
                <select class="form-control select2 {{ $errors->has('doc_type') ? 'is-invalid' : '' }}" name="doc_type_id" id="doc_type_id" >
                 @foreach($doc_types as $id => $doc_type)
                        <option value="{{ $id }}" {{  old('doc_type_id') == $id ? 'selected' : '' }}>{{ $doc_type }}</option>
                    @endforeach 
                </select>
                </div>
            </div>

            <div class="col-4"> 
            <div class="form-group">
                <label   for="date_from">{{ trans('cruds.archive.fields.arc_subject') }}</label>
                <input class="form-control {{ $errors->has('arc_subject') ? 'is-invalid' : '' }}" type="text" name="arc_subject" id="arc_subject" value=" " >
                @if($errors->has('arc_subject'))
                    <span class="text-danger">{{ $errors->first('arc_subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_date_helper') }}</span>
            </div>

            </div>

            
             {{--<div class="form-group">
                <label   for="date_to">{{ trans('cruds.archive.fields.arc_date') }}</label>
                <input class="form-control date {{ $errors->has('arc_date') ? 'is-invalid' : '' }}" type="text" name="date_to" id="date_to"  value=" "  >
                @if($errors->has('date_to'))
                    <span class="text-danger">{{ $errors->first('arc_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_date_helper') }}</span>
            </div>--}}
         {{--    <div class="col-4"> 
                <div class="form-group">
                <label   for="msg_title">{{ trans('cruds.archive.fields.arc_title') }}</label>
                <input class="form-control {{ $errors->has('arc_title') ? 'is-invalid' : '' }}" type="text" name="arc_title" id="arc_title" value=" " >
                @if($errors->has('arc_title'))
                    <span class="text-danger">{{ $errors->first('arc_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_title_helper') }}</span>
            </div>
          
</div>
            
            --}}
             
           
            <div class="col-4"> 
                <div class="form-group">
               <label   for="date_from"> </label>
                    <br>   

                    <button class="btn-lg btn-primary" type="submit">
                        {{ trans('global.search') }}
                    </button>
                </div>
            </div>
              
        
            
           {{-- 
        <div class="row">
           <div class="col-2"> 
            </div>
            <div class="col-10"> 
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.search') }}
                    </button>
                </div>
            </div>
             
        </div>
         
        --}}
        </form>
    </div>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12"> 
        {{ trans('cruds.archive.title_singular') }} {{ trans('global.list') }}
        </div>
        </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Archive">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.archive.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.archive.fields.arc_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.archive.fields.doc_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.archive.fields.arc_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.archive.fields.notes') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($archives as $key => $archive)
                        <tr data-entry-id="{{ $archive->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $archive->id ?? '' }}
                            </td>
                            <td>
                                {{ $archive->arc_date ?? '' }}
                            </td>
                            <td>
                                {{ $archive->doc_type->doc_type_desc ?? '' }}
                            </td>
                            <td>
                                {{ $archive->arc_title ?? '' }}
                            </td>
                            <td>
                                {{ $archive->notes ?? '' }}
                            </td>
                            <td>
                                @can('archive_show')
<!--
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.archives.show', $archive->id) }}">
                                        00{{ trans('global.view') }}
                                    </a>
-->
                                
<!--                                     <form  action="/INOUT/admin/archives/showpost"  method="POST" style="display: inline-block;">-->
                                     <form  action="{{asset('/admin/archives/showpost') }}"  method="POST" style="display: inline-block;">
                                        <input type="hidden" name="idshowpost" value="{{$archive->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input type="submit" class="btn btn-xs btn-primary" value="{{ trans('global.view') }}">
                                    </form>        
                                
                                
                                @endcan

                                @can('archive_edit')
<!--
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.archives.edit', $archive->id) }}">
                                      00  {{ trans('global.edit') }}
                                    </a>
-->
                                
<!--                      <form  action="/INOUT/admin/archives/editpost"  method="POST" style="display: inline-block;">-->
                      <form  action="{{asset('/admin/archives/editpost') }}"  method="POST" style="display: inline-block;">
                                        <input type="hidden" name="ideditpost" value="{{$archive->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" class="btn btn-xs btn-info" value="{{ trans('global.edit') }}">
                                    </form>
                                
                                
                                @endcan

                                @can('archive_delete')
                                    <form action="{{ route('admin.archives.destroy', $archive->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
//       $(document).ready(function(){
//		var date_input=$('input[name="date_from"]'); //our date input has the name "date"
//		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
//		date_input.datepicker({
//			//format: 'mm/dd/yyyy',
//			format: 'dd/mm/yyyy',
//			container: container,
//			todayHighlight: true,
//			autoclose: true,
//            rtl: true
//		})
//	})
//    
//    
//       $(document).ready(function(){
//		var date_input=$('input[name="date_to"]'); //our date input has the name "date"
//		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
//		date_input.datepicker({
//			//format: 'mm/dd/yyyy',
//			format: 'dd/mm/yyyy',
//			container: container,
//			todayHighlight: true,
//			autoclose: true,
//            rtl: true
//		})
//	})
    
    
    
    
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('archive_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.archives.massDestroy') }}",
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
  $('.datatable-Archive:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection