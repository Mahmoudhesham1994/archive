<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\DocType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocTypeRequest;
use App\Http\Requests\UpdateDocTypeRequest;
use App\Http\Resources\Admin\DocTypeResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('doc_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocTypeResource(DocType::all());

    }

    public function store(StoreDocTypeRequest $request)
    {
        $docType = DocType::create($request->all());

        return (new DocTypeResource($docType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(DocType $docType)
    {
        abort_if(Gate::denies('doc_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocTypeResource($docType);

    }

    public function update(UpdateDocTypeRequest $request, DocType $docType)
    {
        $docType->update($request->all());

        return (new DocTypeResource($docType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(DocType $docType)
    {
        abort_if(Gate::denies('doc_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $docType->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}