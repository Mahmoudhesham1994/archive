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

    
<!--    <form method="POST" action="/admin/messages/search">-->
    <form method="POST" action="/INOUT/admin/messages/search">
        @csrf
     <div class="container-fluid ">
        <div class="row">
            <div class="col-4">
            <div class="form-group">
                <label  for="num">{{ trans('cruds.message.fields.num') }}</label>
                <input class="form-control {{ $errors->has('num') ? 'is-invalid' : '' }}" type="text" name="num" id="num" value="" >
                @if($errors->has('num'))
                    <span class="text-danger">{{ $errors->first('num') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.num_helper') }}</span>
            </div>
                
            </div>

            <div class="col-8">
            <div class="form-group">
                <label   for="msg_title">{{ trans('cruds.message.fields.msg_title') }}</label>
                <input class="form-control {{ $errors->has('msg_title') ? 'is-invalid' : '' }}" type="text" name="msg_title" id="msg_title" value=" " >
                @if($errors->has('msg_title'))
                    <span class="text-danger">{{ $errors->first('msg_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_title_helper') }}</span>
            </div>

            </div>
        </div>
       {{-- <div class="w-100"></div> --}}
        <div class="row">
            <div class="col-4"> 
                <div class="form-group">
                <label   for="msg_type_id">{{ trans('cruds.message.fields.msg_type') }}</label>
                <select class="form-control select2 {{ $errors->has('msg_type') ? 'is-invalid' : '' }}" name="msg_type_id" id="msg_type_id" >
                    @foreach($msg_types as $id => $msg_type)
                        <option value="{{ $id }}" {{  old('msg_type_id') == $id ? 'selected' : '' }}>{{ $msg_type }}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="col-4"> 
            <div class="form-group">
                <label   for="date_from">{{ trans('cruds.message.fields.msg_date') }}</label>
                <input class="form-control" type="date" name="date_from" id="date_from"  value=" "  >
               {{--  <input class="form-control date {{ $errors->has('msg_date') ? 'is-invalid' : '' }}" type="text" name="date_from" id="date_from"  value=" "  > --}}
                @if($errors->has('date_from'))
                    <span class="text-danger">{{ $errors->first('msg_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_date_helper') }}</span>
            </div>

            </div>

            <div class="col-4"> 
            <div class="form-group">
                <label   for="date_to">{{ trans('cruds.message.fields.msg_date') }}</label>
               {{--  <input class="form-control date {{ $errors->has('msg_date') ? 'is-invalid' : '' }}" type="text" name="date_to" id="date_to"  value=" "  > --}}
                <input class="form-control   " type="date" name="date_to" id="date_to"  value=" "  >
                @if($errors->has('date_to'))
                    <span class="text-danger">{{ $errors->first('msg_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_date_helper') }}</span>
            </div>
             

         
        </div>
 </div>

        <div class="row"> 
            
             <div class="col-4"> 
             <div class="form-group">
                <label for="from_contact_id">{{ trans('cruds.message.fields.from_contact') }}</label>
                <select class="form-control select2 {{ $errors->has('from_contact') ? 'is-invalid' : '' }}" name="from_contact_id" id="from_contact_id">
                    @foreach($from_contacts as $id => $from_contact)
                        <option value="{{ $id }}" {{ old('from_contact_id') == $id ? 'selected' : '' }}>{{ $from_contact }}</option>
                    @endforeach
                </select>
                @if($errors->has('from_contact'))
                    <span class="text-danger">{{ $errors->first('from_contact') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.from_contact_helper') }}</span>
            </div>
            </div>
             <div class="col-4"> 
                  <div class="form-group">
                <label for="forward_to_id">{{ trans('cruds.message.fields.forward_to') }}</label>
                <select class="form-control select2 {{ $errors->has('forward_to') ? 'is-invalid' : '' }}" name="forward_to_id" id="forward_to_id">
                    @foreach($forward_tos as $id => $forward_to)
                        <option value="{{ $id }}" {{ old('forward_to_id') == $id ? 'selected' : '' }}>{{ $forward_to }}</option>
                    @endforeach
                </select>
                @if($errors->has('forward_to'))
                    <span class="text-danger">{{ $errors->first('forward_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.forward_to_helper') }}</span>
            </div>
             </div> 
            
            <div class="col-4"> 
                <br>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.search') }}
                    </button>
                </div>
            </div>    
        </div>
         
        
        </form>
        <div class="container-fluid ">
        <div class="row">
            <div class="col-12"> 
    {{ trans('cruds.message.title_singular') }} {{ trans('global.list') }}
        </div>
        </div>
        </div>
<!-- </div>-->
 
{{--     <div class="col-md-4">
 <label>Num</label> <input type="text" name="Num">

</div>
 --}}

{{--        <div class="col-md-4">
<label>Date From</label> <input name="date_from" type="date">
           --}}

{{-- </div>
            <div class="col-md-4">
      
       <label>Date From</label>       <input name="date_to" type="date">
     </div>
    
             
    
     

</div>--}}
{{--             <div class="row">
                    <div class="col-md-4">
            <label>Msg Type</label> 
                        
            <!--            <input type="text" name="msg_type">-->
            <select style="width:148px; height:30px;"  name="msg_type_id" id="msg_type_id" >
                                @foreach($msg_types as $id => $msg_type)
                                    <option value="{{ $id }}" {{ old('msg_type_id') == $id ? 'selected' : '' }}>{{ $msg_type }}</option>
                                @endforeach
                            </select>
            </div> --}}

{{-- 
      <div class="col-md-4">
<label>Msg Title</label> <input type="text" name="msg_title"> --}}

{{-- </div>
      <div class="col-md-4">
     <input type="submit" value="بحث" style="width:130px;" class="btn btn-primary ">
          </div>
    </div>
 </form> --}}
         
         
    

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Message">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
<!--
                        <th>
                            {{ trans('cruds.message.fields.id') }}
                        </th>
-->
                        <th>
                            {{ trans('cruds.message.fields.num') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.msg_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.msg_type') }}
                        </th>
<!--
                        <th>
                            33{{ trans('cruds.message.fields.doc_type') }}
                        </th>
-->
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
<!--
                        <th>
                          MM  {{ trans('cruds.message.fields.rel_num') }}
                        </th>
-->
                        <th>
                            {{ trans('cruds.message.fields.sent_to') }}
                        </th>
<!--
                        <th>
                            موجهة الى
                        </th>
-->
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
                            {{--<td>
                                {{ $message->id ?? '' }}
                            </td>--}}
                            <td>
                                {{ $message->num ?? '' }}
                            </td>
                            <td>
                                {{ $message->msg_date ?? '' }}
                            </td>
                            <td>
                                {{ $message->msg_type->msg_type_desc ?? '' }}
                            </td>
                            {{--<td>
                             33   {{ $message->doc_type->doc_type_desc ?? '' }}
                            </td>--}}
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
                            {{--<td>
                               MMM {{ $message->rel_num->num ?? '' }}
                            </td>--}}
                            <td>
                                @foreach($message->sent_tos as $key => $item)
                                    <span class="badge badge-info">{{ $item->contact_name }}</span>
                                @endforeach
                            </td>
                             {{--<td>
                                @foreach($message->forward_to as $key => $item)
                                    <span class="badge badge-info">{{ $item->contact_name }}</span>
                                @endforeach
                            </td>--}}
                            <td>
                                @can('message_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.messages.show', $message->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('message_edit')
<!--
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.messages.edit', $message->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
-->
                         <form  action="/INOUT/admin/messages/editpost"  method="POST" style="display: inline-block;">
                                        <input type="hidden" name="ideditpost" value="{{$message->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="submit" class="btn btn-xs btn-info" value="{{ trans('global.edit') }}">
                                    </form>
                                
                                
                                
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

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>




<script>
//        	$(document).ready(function(){
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
//     	$(document).ready(function(){
//		var date_input=$('input[name="date_to"]'); //our date input has the name "date"
//		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
//		date_input.datepicker({
//			//format: 'mm/dd/yyyy',
//            format: 'dd/mm/yyyy',
//			container: container,
//			todayHighlight: true,
//			autoclose: true,
//            rtl: true
//		})
//	})
//    
    
    
    
    
    
    
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