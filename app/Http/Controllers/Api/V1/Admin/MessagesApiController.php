<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Resources\Admin\MessageResource;
use App\Message;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessagesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('message_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MessageResource(Message::with(['msg_type', 'doc_type', 'from_contact', 'priority', 'rel_num', 'sent_tos', 'forward_to'])->get());

    }

    public function store(StoreMessageRequest $request)
    {
        $message = Message::create($request->all());
        $message->sent_tos()->sync($request->input('sent_tos', []));

        if ($request->input('message_doc', false)) {
            $message->addMedia(storage_path('tmp/uploads/' . $request->input('message_doc')))->toMediaCollection('message_doc');
        }

        return (new MessageResource($message))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Message $message)
    {
        abort_if(Gate::denies('message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MessageResource($message->load(['msg_type', 'doc_type', 'from_contact', 'priority', 'rel_num', 'sent_tos', 'forward_to']));

    }

    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->all());
        $message->sent_tos()->sync($request->input('sent_tos', []));

        if ($request->input('message_doc', false)) {
            if (!$message->message_doc || $request->input('message_doc') !== $message->message_doc->file_name) {
                $message->addMedia(storage_path('tmp/uploads/' . $request->input('message_doc')))->toMediaCollection('message_doc');
            }

        } elseif ($message->message_doc) {
            $message->message_doc->delete();
        }

        return (new MessageResource($message))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Message $message)
    {
        abort_if(Gate::denies('message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $message->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}