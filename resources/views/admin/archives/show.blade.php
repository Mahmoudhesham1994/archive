@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.archive.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.archives.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.archive.fields.id') }}
                        </th>
                        <td>
                            {{ $archive->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archive.fields.arc_date') }}
                        </th>
                        <td>
                            {{ $archive->arc_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archive.fields.doc_type') }}
                        </th>
                        <td>
                            {{ $archive->doc_type->doc_type_desc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archive.fields.arc_title') }}
                        </th>
                        <td>
                            {{ $archive->arc_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archive.fields.arc_subject') }}
                        </th>
                        <td>
                            {{ $archive->arc_subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archive.fields.notes') }}
                        </th>
                        <td>
                            {{ $archive->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.archive.fields.archive_doc') }}
                        </th>
                        <td>
                            
           
                            
                            
                            
                            
                            @foreach($archive->archive_doc as $key => $media)
<!--             <a href="http://localhost:8000/archive/{{$media->file_name}}" target="_blank">-->
 <!--             <a href="{{Storage::disk('fileStore')->url($media->file_name)}}" target="_blank">-->
             <a href="http://172.23.101.244/INOUT/public/archive/{{$media->file_name}}" target="_blank">
                 {{ trans('global.view_file') }}</a>
<!--
                                <a href="{{ substr_replace($media->getUrl(),":8000",16,0)}}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
-->
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.archives.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection