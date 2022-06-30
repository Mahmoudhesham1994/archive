<?php

namespace App\Http\Controllers\Admin;

use App\DocType;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDocTypeRequest;
use App\Http\Requests\StoreDocTypeRequest;
use App\Http\Requests\UpdateDocTypeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('doc_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $docTypes = DocType::all();

        return view('admin.docTypes.index', compact('docTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('doc_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.docTypes.create');
    }

    public function store(StoreDocTypeRequest $request)
    {
        $docType = DocType::create($request->all());

        return redirect()->route('admin.doc-types.index');

    }

    public function edit(DocType $docType)
    {
        abort_if(Gate::denies('doc_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.docTypes.edit', compact('docType'));
    }

    public function update(UpdateDocTypeRequest $request, DocType $docType)
    {
        $docType->update($request->all());

        return redirect()->route('admin.doc-types.index');

    }

    public function show(DocType $docType)
    {
        abort_if(Gate::denies('doc_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.docTypes.show', compact('docType'));
    }

    public function destroy(DocType $docType)
    {
        abort_if(Gate::denies('doc_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $docType->delete();

        return back();

    }

    public function massDestroy(MassDestroyDocTypeRequest $request)
    {
        DocType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}