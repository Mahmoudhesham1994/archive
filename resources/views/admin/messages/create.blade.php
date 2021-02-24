@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.message.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.messages.store") }}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                 <label class="required" for="num">{{ trans('cruds.message.fields.num') }}</label> 
<!--                 <input class="form-control {{ $errors->has('num') ? 'is-invalid' : '' }}" type="text" name="num" id="num" value="{{ old('num', '') }}" required> -->
<!--             <input readonly class="form-control {{ $errors->has('num') ? 'is-invalid' : '' }}" type="text" name="num" id="num" value="{{ old('num', $message_id) }}" required> -->

    <input readonly class="form-control {{ $errors->has('num') ? 'is-invalid' : '' }}" type="text" name="num" id="num" value="0000" disapled> 


<!--
                @if($errors->has('num'))
                    <span class="text-danger">{{ $errors->first('num') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.num_helper') }}</span>
-->
            </div>
            <div class="form-group">
                <label class="required" for="msg_date">{{ trans('cruds.message.fields.msg_date') }}</label>
                <input style="left: auto ;right: 0;" class="form-control date {{ $errors->has('msg_date') ? 'is-invalid' : '' }}" type="text" name="msg_date" id="msg_date" value="{{ old('msg_date') }}" required>
                @if($errors->has('msg_date'))
                    <span class="text-danger">{{ $errors->first('msg_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="msg_type_id">{{ trans('cruds.message.fields.msg_type') }}</label>
                <select class="form-control select2 {{ $errors->has('msg_type') ? 'is-invalid' : '' }}" name="msg_type_id" id="msg_type_id" required>
                    @foreach($msg_types as $id => $msg_type)
                        <option value="{{ $id }}" {{ old('msg_type_id') == $id ? 'selected' : '' }}>{{ $msg_type }}</option>
                    @endforeach
                </select>
            @if($errors->has('msg_type'))
                    <span class="text-danger">{{ $errors->first('msg_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="doc_type_id">{{ trans('cruds.message.fields.doc_type') }}</label>
                <select class="form-control select2 {{ $errors->has('doc_type') ? 'is-invalid' : '' }}" name="doc_type_id" id="doc_type_id">
                    @foreach($doc_types as $id => $doc_type)
                        <option value="{{ $id }}" {{ old('doc_type_id') == $id ? 'selected' : '' }}>{{ $doc_type }}</option>
                    @endforeach
                </select>
            @if($errors->has('doc_type'))
                    <span class="text-danger">{{ $errors->first('doc_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.doc_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="msg_title">{{ trans('cruds.message.fields.msg_title') }}</label>
                <input class="form-control {{ $errors->has('msg_title') ? 'is-invalid' : '' }}" type="text" name="msg_title" id="msg_title" value="{{ old('msg_title', '') }}" required>
                @if($errors->has('msg_title'))
                    <span class="text-danger">{{ $errors->first('msg_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="msg_subject">{{ trans('cruds.message.fields.msg_subject') }}</label>
                <textarea class="form-control {{ $errors->has('msg_subject') ? 'is-invalid' : '' }}" name="msg_subject" id="msg_subject">{{ old('msg_subject') }}</textarea>
                @if($errors->has('msg_subject'))
                    <span class="text-danger">{{ $errors->first('msg_subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="msg_desc">{{ trans('cruds.message.fields.msg_desc') }}</label>
                <input class="form-control {{ $errors->has('msg_desc') ? 'is-invalid' : '' }}" type="text" name="msg_desc" id="msg_desc" value="{{ old('msg_desc', '') }}">
                @if($errors->has('msg_desc'))
                    <span class="text-danger">{{ $errors->first('msg_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.msg_desc_helper') }}</span>
            </div>
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
            <div class="form-group">
                <label for="priority_id">{{ trans('cruds.message.fields.priority') }}</label>
                <select class="form-control select2 {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority_id" id="priority_id">
                    @foreach($priorities as $id => $priority)
                        <option value="{{ $id }}" {{ old('priority_id') == $id ? 'selected' : '' }}>{{ $priority }}</option>
                    @endforeach
                </select>
                @if($errors->has('priority'))
                    <span class="text-danger">{{ $errors->first('priority') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.priority_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.message.fields.msg_statuses') }}</label>
                <select class="form-control select2 " name="status_id" id="status_id">
                    @foreach($msgStatus as $id => $msgstat)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $msgstat }}</option>
                    @endforeach
                </select>
            
                <span class="help-block">{{ trans('cruds.message.fields.msg_statuses_helper') }}</span>
            </div>
            
            <div class="form-group">
                <div class="form-check {{ $errors->has('need_replay') ? 'is-invalid' : '' }}">
                   <label class="form-check-label" for="need_replay">{{ trans('cruds.message.fields.need_replay') }}</label> 
                    
                    <input type="hidden" name="need_replay" value="0">
                <input class="form-check-input" type="checkbox" name="need_replay" id="need_replay" value="1" {{ old('need_replay', 0) == 1 ? 'checked' : '' }}>
                    
                </div>
                @if($errors->has('need_replay'))
                <span class="text-danger">{{ $errors->first('need_replay') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.need_replay_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="replay_date">{{ trans('cruds.message.fields.replay_date') }}</label>
                <input class="form-control date {{ $errors->has('replay_date') ? 'is-invalid' : '' }}" type="text" name="replay_date" id="replay_date" value="{{ old('replay_date') }}">
                @if($errors->has('replay_date'))
                    <span class="text-danger">{{ $errors->first('replay_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.replay_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rel_num_id">{{ trans('cruds.message.fields.rel_num') }}</label>
                <select class="form-control select2 {{ $errors->has('rel_num') ? 'is-invalid' : '' }}" name="rel_num_id" id="rel_num_id">
                    @foreach($rel_nums as $id => $rel_num)
                <option value="{{ $id }}" {{ old('rel_num_id') == $id ? 'selected' : '' }}>{{ $rel_num }}</option> 
                    
 
                     
                    @endforeach
                </select>
                @if($errors->has('rel_num'))
                    <span class="text-danger">{{ $errors->first('rel_num') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.rel_num_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label for="sent_tos">{{ trans('cruds.message.fields.sent_to') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('sent_tos') ? 'is-invalid' : '' }}" name="sent_tos[]" id="sent_tos" multiple>
                    @foreach($sent_tos as $id => $sent_to)
                        <option value="{{ $id }}" {{ in_array($id, old('sent_tos', [])) ? 'selected' : '' }}>{{ $sent_to }}</option>
                    @endforeach
                </select>
                @if($errors->has('sent_tos'))
                    <span class="text-danger">{{ $errors->first('sent_tos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.sent_to_helper') }}</span>
            </div>
            
             
               {{--<div class="form-group">
                <label for="sent_tos">{{ trans('cruds.message.fields.forward_to') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('forward_to') ? 'is-invalid' : '' }}" name="forward_to[]" id="forward_to" multiple>
                    @foreach($forward_tos as $id => $forward_to)
          <option value="{{ $id }}" {{ in_array($id, old('forward_to', [])) ? 'selected' : '' }}>{{ $forward_to }}</option>
                    @endforeach
                </select>
                @if($errors->has('forward_to'))
                    <span class="text-danger">{{ $errors->first('forward_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.forward_to_helper') }}</span>
            </div>--}}
            
            
            {{--<div class="form-group">
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
            </div>--}}
            
            <div class="form-group">
                <label for="message_doc">{{ trans('cruds.message.fields.message_doc') }}</label>
                
                
<!--
                <div class="needsclick dropzone {{ $errors->has('message_doc') ? 'is-invalid' : '' }}" id="message_doc-dropzone">
                </div>
                @if($errors->has('message_doc'))
                    <span class="text-danger">{{ $errors->first('message_doc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.message_doc_helper') }}</span>
-->
        <div class="input-group control-group increment" >
          <input type="file" name="message_doc[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="message_doc[]" class="form-control">
            <div class="input-group-btn"> 
              <!--<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>-->
              <button class="btn btn-danger" type="button"><i class=""></i> Remove</button>
            </div>
          </div>
        </div>           
                
            </div>
<!--             <input   class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>-->
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>-->

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    
    	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			//format: 'mm/dd/yyyy',
			 format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
            rtl: true
		})
	})
    
     	$(document).ready(function(){
		var date_input=$('input[name="replay_date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			//format: 'mm/dd/yyyy',
            format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
            rtl: true
		})
	})
    
      	$(document).ready(function(){
		var date_input=$('input[name="msg_date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			//format: 'mm/dd/yyyy',
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
            rtl: true
		})
	})
//    $(document).ready(function() {
//$('.js-example-basic-multiple').select2();
//});

    
     $(document).ready(function() {
 
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
 
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
 
    });
    
//    var uploadedMessageDocMap = {};
//Dropzone.options.messageDocDropzone = {
//    url: '{{ route('admin.messages.storeMedia') }}',
//    maxFilesize: 20, // MB
//    addRemoveLinks: true,
//    headers: {
//      'X-CSRF-TOKEN': "{{ csrf_token() }}"
//    },
//    params: {
//      size: 20
//    },
//    success: function (file, response) {
//      $('form').append('<input type="hidden" name="message_doc[]" value="' + response.name + '">')
//      uploadedMessageDocMap[file.name] = response.name
//    },
//    removedfile: function (file) {
//      file.previewElement.remove()
//      var name = ''
//      if (typeof file.file_name !== 'undefined') {
//        name = file.file_name
//      } else {
//        name = uploadedMessageDocMap[file.name]
//      }
//      $('form').find('input[name="message_doc[]"][value="' + name + '"]').remove()
//    },
//    init: function () {
//@if(isset($message) && $message->message_doc)
//          var files =
//            {!! json_encode($message->message_doc) !!}
//              for (var i in files) {
//              var file = files[i]
//              this.options.addedfile.call(this, file)
//              file.previewElement.classList.add('dz-complete')
//              $('form').append('<input type="hidden" name="message_doc[]" value="' + file.file_name + '">')
//            }
//@endif
//    },
//     error: function (file, response) {
//         if ($.type(response) === 'string') {
//             var message = response //dropzone sends it's own error messages in string
//         } else {
//             var message = response.errors.file
//         }
//         file.previewElement.classList.add('dz-error')
//         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
//         _results = []
//         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
//             node = _ref[_i]
//             _results.push(node.textContent = message)
//         }
//
//         return _results
//     }
//}
</script>

@endsection