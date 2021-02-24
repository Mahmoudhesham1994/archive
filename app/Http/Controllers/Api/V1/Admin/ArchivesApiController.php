<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Archive;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreArchiveRequest;
use App\Http\Requests\UpdateArchiveRequest;
use App\Http\Resources\Admin\ArchiveResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArchivesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('archive_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArchiveResource(Archive::with(['doc_type'])->get());

    }

    public function store(StoreArchiveRequest $request)
    {
        $archive = Archive::create($request->all());

        if ($request->input('archive_doc', false)) {
            $archive->addMedia(storage_path('tmp/uploads/' . $request->input('archive_doc')))->toMediaCollection('archive_doc');
        }

        return (new ArchiveResource($archive))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Archive $archive)
    {
        abort_if(Gate::denies('archive_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArchiveResource($archive->load(['doc_type']));

    }

    public function update(UpdateArchiveRequest $request, Archive $archive)
    {
        $archive->update($request->all());

        if ($request->input('archive_doc', false)) {
            if (!$archive->archive_doc || $request->input('archive_doc') !== $archive->archive_doc->file_name) {
                $archive->addMedia(storage_path('tmp/uploads/' . $request->input('archive_doc')))->toMediaCollection('archive_doc');
            }

        } elseif ($archive->archive_doc) {
            $archive->archive_doc->delete();
        }

        return (new ArchiveResource($archive))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Archive $archive)
    {
        abort_if(Gate::denies('archive_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $archive->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}