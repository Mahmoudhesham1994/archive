@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.archive.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.archives.update", [$archive->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="form-group">
                 <label class="required" for="num">{{ trans('cruds.message.fields.num') }}</label> 
    <input readonly class="form-control {{ $errors->has('num') ? 'is-invalid' : '' }}" type="text" name="num" id="num" value="{{ old('num', $archive->num) }}" disapled> 


            </div>
            <div class="form-group">
                <label class="required" for="arc_date">{{ trans('cruds.archive.fields.arc_date') }}</label>
<!--                                <label>{{$archive->arc_date}}</label>-->

                <input class="form-control date {{ $errors->has('arc_date') ? 'is-invalid' : '' }}" type="text" name="arc_date" id="arc_date" value="{{ old('arc_date', $archive->arc_date) }}" required>
                @if($errors->has('arc_date'))
                    <span class="text-danger">{{ $errors->first('arc_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.archive.fields.arc_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="doc_type_id">{{ trans('cruds.archive.fields.doc_type') }}</label>
                <select class="form-control select2 {{ $errors->has('doc_type') ? 'is-invalid' : '' }}" name="doc_type_id" id="doc_type_id">
                    @foreach($doc_types as $id => $doc_type)
                        <option value="{{ $id }}" {{ ($archive->doc_type ? $archive->doc_type->id : old('doc_type_id')) == $id ? 'selected' : '' }}>{{ $doc_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('doc_type'))
                    <span class="text-danger">{{ $errors->first('doc_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.archive.fields.doc_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="arc_title">{{ trans('cruds.archive.fields.arc_title') }}</label>
                <input class="form-control {{ $errors->has('arc_title') ? 'is-invalid' : '' }}" type="text" name="arc_title" id="arc_title" value="{{ old('arc_title', $archive->arc_title) }}" required>
                @if($errors->has('arc_title'))
                    <span class="text-danger">{{ $errors->first('arc_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.archive.fields.arc_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="arc_subject">{{ trans('cruds.archive.fields.arc_subject') }}</label>
                <textarea class="form-control {{ $errors->has('arc_subject') ? 'is-invalid' : '' }}" name="arc_subject" id="arc_subject">{{ old('arc_subject', $archive->arc_subject) }}</textarea>
                @if($errors->has('arc_subject'))
                    <span class="text-danger">{{ $errors->first('arc_subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.archive.fields.arc_subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.archive.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $archive->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.archive.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="archive_doc">{{ trans('cruds.archive.fields.archive_doc') }}</label>
<!--
                <div class="needsclick dropzone {{ $errors->has('archive_doc') ? 'is-invalid' : '' }}" id="archive_doc-dropzone">
                </div>
                @if($errors->has('archive_doc'))
                    <span class="text-danger">{{ $errors->first('archive_doc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.archive.fields.archive_doc_helper') }}</span>
-->
                  <br>
                
                   @foreach($archive->archive_doc as $key => $media)
<!--                                 <a href="{{ substr_replace($media->getUrl(),":8000",16,0) }}" target="_blank">-->
                
                
                             <a href="http://172.23.101.244/INOUT/public/archive/{{$media->file_name}}" target="_blank">

                                    {{ trans('global.view_file') }}
                                 </a>
<!--                 <a href="/admin/messages/delete/{{$media->id}}">{{$media->id}}حذف</a>-->
                <a class="btn btn-danger" onclick="return confirm('هل متأكد من الحذف?')" href=" /admin/archives/delete/{{$media->id}}"><i class="fa fa-trash"></i></a>

                <br><br>
                            @endforeach
                 <br>
              
         <div class="input-group control-group increment" >
          <input type="file" name="archive_doc[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="archive_doc[]" class="form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
        </div>             
                
                
                
                
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

@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
        $(document).ready(function(){
		var date_input=$('input[name="arc_date"]'); //our date input has the name "date"
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
    
    
    
    
     $(document).ready(function() {
 
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
 
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
 
    });
    
    
    var uploadedArchiveDocMap = {}
Dropzone.options.archiveDocDropzone = {
    url: '{{ route('admin.archives.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="archive_doc[]" value="' + response.name + '">')
      uploadedArchiveDocMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedArchiveDocMap[file.name]
      }
      $('form').find('input[name="archive_doc[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($archive) && $archive->archive_doc)
          var files =
            {!! json_encode($archive->archive_doc) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="archive_doc[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection