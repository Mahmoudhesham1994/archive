<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\DocType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMessageRequest;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Message;
use App\MsgType;
use App\Priority;
use App\MsgStatus;
use App\Mediaa;

use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Facades\Storage;

class MessagesController extends Controller
{
    use MediaUploadingTrait;
//public function search(Request $request)
//
//{
//    $num = $request->Num;
//    $msg_title = $request->msg_title;
//    $msg_search = Message::where('num',$num)
//       ->where('msg_title',$msg_search)
//        ->get();
//    echo $msg_search;
//    
//}
   //$msg_search = Message::where('num',$num)
//->where('msg_title',$msg_title)
//->get();
//        
//    $msg_search = Message::where('num',$num)
//->where('msg_title',$msg_title)
//->whereBetween('msg_date', [$date_form, $date_to])
//->get();
    
//  $messages = Message::where('num',$num)
//->Orwhere('msg_title',$msg_title)
//->OrwhereBetween('msg_date', [$date_form, $date_to])
//->get();
 //echo $messages;
//   $messages = DB::table('messages')
//->join('msg_types', 'messages.msg_type_id', '=', 'msg_types.id')
//->where('num',$num)
//->Orwhere('msg_title',$msg_title)
//->Orwhere('msg_types.id',$msg_type_id)
//->OrwhereBetween('msg_date', [$date_form, $date_to])
//->get();
    
     
    
    
    
        public function dashord()
        {
            
          return view('admin.messages.dashord');
  
        }
         public function search_msg_title(Request $request)
        {
              if($request->msg_title=="")
       {
         //  dd($request);
                   $messages = Message::all();
        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.messages.index', compact('messages','msg_types'));

           
       }else{
            $messages = Message::where('msg_title','like','%' . $msg_title .'%')
           ->get();
                  
                  echo $messages;
        }
        }
    public function search(Request $request)
{
        //echo $request;
       // dd($request);
        
       if($request->num==""&$request->date_from==""&$request->date_to==""&$request->msg_type_id==""&$request->msg_title==""&$request->from_contact_id==""&$request->forward_to_id=="")
       {
         //  dd($request);
                   $messages = Message::all();
        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
             $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.messages.index', compact('messages','msg_types','from_contacts','forward_tos'));

           
       }else{
$num = $request->num;
$msg_title = $request->msg_title;
 $date_form = $request->date_from;
$date_to = $request->date_to;
$msg_type_id = $request->msg_type_id;
       
           
           
                  $messages = Message::
           
//           wherehas('msg_type', function ($query) use ($msg_type_id)  {
//         $query->where("msg_type_id", $msg_type_id);
//              }) 
               
          when($request->msg_type_id, function($query) use ($request){
    $query->whereHas('msg_type', function($q) use ($request) {
        
            $q->whereIn('msg_type_id', [$request->msg_type_id]);
        
    });
})
                        ->when(($request->date_from &&  $request->date_to), function($query) use ($request){
    $query->whereBetween('msg_date', [ $request->date_from,$request->date_to  ]);
})  
          ->when($request->from_contact_id, function($query) use ($request){
    $query->whereHas('from_contact', function($q) use ($request) {
        
            $q->whereIn('from_contact_id', [$request->from_contact_id]);
        
    });
}) 
          ->when($request->forward_to_id, function($query) use ($request){
    $query->whereHas('forward_to', function($q) use ($request) {
        
            $q->whereIn('forward_to_id', [$request->forward_to_id]);
        
    });
})          
      
               //  ->Orwhere('num','like','%'.$num.'%')
               // ->where('msg_title','like','%'.$request->msg_title.'%')
              
     
->when($request->msg_title, function($query) use ($request){
    $query->where('msg_title','like','%' .$request->msg_title.'%');
})  
   ->when($request->num, function($query) use ($request){
    $query->where('num','like','%' .$request->num.'%');
})            
              
              ->get();
         //  echo count($mmm);
                  $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
        
          $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
//echo $messages;
//           die();
       return view('admin.messages.index', compact('messages','msg_types','from_contacts','forward_tos'));

//           die();
//        
////$messages = Message::wherehas('msg_type', function ($query) use ($msg_type_id)  {
////$query->where("msg_type_id", $msg_type_id);
////}) 
////->Orwhere('num',$num)
////->Orwhere('msg_title','like','%' .$msg_title.'%')
////->OrwhereBetween('msg_date', [$date_form, $date_to])
////->get();
//// 
////   echo $request;
//         //  echo $num;
//          //dd($msg_title);
//          //  dd($request);
//          // dd($request->msg_type_id);
//           $messages = Message::
//           
////           wherehas('msg_type', function ($query) use ($msg_type_id)  {
////         $query->where("msg_type_id", $msg_type_id);
////              }) 
//               
//          when($request->msg_type_id, function($query) use ($request){
//    $query->whereHas('msg_type', function($q) use ($request) {
//        
//            $q->whereIn('msg_type_id', [$request->msg_type_id]);
//        
//    });
//})            
//         //  ->OrwhereBetween('msg_date', [$date_form, $date_to])
//            // ->Orwhere('num',$num)
//                ->Orwhere('num','like','%'.$num.'%')
//           //  ->Orwhere('msg_title','like','%' . $msg_title .'%')
//         // ->Orwhere('msg_title','like','%v%')
//               ->where('msg_title','like','%'.$request->msg_title.'%')
//         //        ->Orwhere('msg_title', $msg_title)
//               
//                     ->when(($request->date_from &&  $request->date_to), function($query) use ($request){
//    $query->whereBetween('msg_date', [ $request->date_from,$request->date_to  ]);
//})  
//          ->when($request->from_contact_id, function($query) use ($request){
//    $query->whereHas('from_contact', function($q) use ($request) {
//        
//            $q->whereIn('from_contact_id', [$request->from_contact_id]);
//        
//    });
//}) 
//          ->when($request->forward_to_id, function($query) use ($request){
//    $query->whereHas('forward_to', function($q) use ($request) {
//        
//            $q->whereIn('forward_to_id', [$request->forward_to_id]);
//        
//    });
//})          
//  
//       ->get();
//    
//          // echo strlen($request->msg_title);
//         //  dd($messages);
//       // echo $messages;
//       $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
//        
//          $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
//        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
////echo $messages;
////           die();
//       return view('admin.messages.index', compact('messages','msg_types','from_contacts','forward_tos'));
           
           }
 }
    public function index()
    {
        abort_if(Gate::denies('message_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       // $messages = Message::all();
        $messages = Message::orderBy('msg_date','DESC')->get();

        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
  $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.messages.index', compact('messages','msg_types','from_contacts','forward_tos'));
    }

    public function create()
    {
        abort_if(Gate::denies('message_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::all()->pluck('priority_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $msgStatus = MsgStatus::all()->pluck('msg_status_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $rel_nums = Message::all()->pluck('FullName', 'id')->prepend(trans('global.pleaseSelect'), '');

//       $rel_nums = Message::all();
//    //    dd($rel_nums);
//          // ->pluck('new_name','num', 'id')
//          // ->prepend(trans('global.pleaseSelect'), '');
//        
//         $rel_nums =  collect($rel_nums); 
//       // dd($rel_nums);
//      $rel_nums = $rel_nums->map(function ($rel_num){
//$rel_num->n_title = $rel_num->num."  ".$rel_num->msg_title."  ".$rel_num->id;
//return $rel_num;
//}); 
       //   ->pluck('new_name','num', 'id');
       // dd($rel_nums);
         //  ->prepend(trans('global.pleaseSelect'), '');;
        
       $msg_title = Message::all()->pluck('msg_title', 'id');
     //   $rel_nums = Message::all()->pluck('num', 'id')->pluck('num', 'id', 'msg_title')->prepend(trans('global.pleaseSelect'), '');

 // $rel_nums = Message::all()->pluck('num', 'id', 'msg_title')->prepend(trans('global.pleaseSelect'), '');


        $sent_tos = Contact::all()->pluck('contact_name', 'id');

        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
      //  $message_id = Message::max('id')+1;
$message_id = date('Y')+Message::max('id')+1;
        
 // $msg_title = Message::all()->pluck('num', 'id')->prepend(trans('global.pleaseSelect'), '');
//        $message = new Message;
//     echo $message->new_name;
       // return $this->msg_date->toDateTimeString().$this->msg_title;
// echo $msg_title;
//         foreach($rel_nums as $id => $rel_num){
//        $messages = DB::table('messages')->where('id',$id)->get();
//                        echo $messages->;
//             
//             }
         
       // $message = Message::all() 
            $msg = Message::get();
//
//    foreach ($msg as  $m) {
//         echo $m->full_name .'<br>';
//    }
        
//    $msg_rel = DB::table('messages')->select('id', DB::raw("CONCAT(messages.num,' ',messages.msg_title) AS full_name"))->get()->pluck('full_name', 'id');
//    foreach ($msg_rel as  $id=>$m) {
//       //  echo $m->full_name .'<br>';
//     //    echo $id."id".$m."<br>";
//    }

      //echo $rel_nums; 
//        foreach($rel_nums as $id=>$s)
//        {
//            echo $id."iii".$s."<br>";
//        }
    return view('admin.messages.create', compact('msgStatus','msg_types', 'doc_types', 'from_contacts', 'priorities', 'rel_nums', 'sent_tos','msg_title', 'forward_tos','message_id'));
    }
    
    
      public function show_select2()
    {
                  abort_if(Gate::denies('message_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::all()->pluck('priority_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $rel_nums = Message::all()->pluck('FullName', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sent_tos = Contact::all()->pluck('contact_name', 'id');

        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
      //  $message_id = Message::max('id')+1;
$message_id = date('Y')+Message::max('id')+1;
        return view('admin.archives.show_select2', compact('doc_types', 'from_contacts', 'priorities', 'rel_nums', 'sent_tos', 'forward_tos','message_id'));
      
    }

    public function store(StoreMessageRequest $request)
    {
               $messages = MsgType::where('id',$request->msg_type_id)->get();
          $msg_type_num = $messages[0]->msg_type_num ;
        // echo $msg_type_num."<br>";
//      $num_mesg = date('Y').'-'.$msg_type_num;
//
               //$msg =  Message::where('num', $num_mesg)->get();
               $msg =  Message::all();
       //  echo count($msg);
          $stack = [];
        
               foreach($msg as $m)
             {
                   
                 $str_n = substr($m->num,5,-5);
                  // echo $str_n;
                if($str_n == $msg_type_num)
                 
                {
               //     echo "success"."<br>";
                  
       array_push($stack,$str_n );

                }
             }
       // print_r($stack);
$count_type =  count($stack)+1;
    // $num_mesg = date('Y').'-'.$msg_type_num.'-'.$count_type; 
    if($count_type<10){
             $num_mesg = date('Y').'-'.$msg_type_num.'-'."000".$count_type; 
       //  echo $num_mesg;
        }
        elseif($count_type >=10 && $count_type <=99)
        {
           $num_mesg = date('Y').'-'.$msg_type_num.'-'."00".$count_type; 
        // echo $num_mesg;
   
        }
            elseif($count_type >=100 && $count_type <=999 )
        {
           $num_mesg = date('Y').'-'.$msg_type_num.'-'."0".$count_type; 
        //    echo $num_mesg;
        }
         elseif($count_type >=1000 && $count_type <=9999 )
        {
           $num_mesg = date('Y').'-'.$msg_type_num.'-'."".$count_type; 
         //   echo $num_mesg;
        }

                
        $message = new Message;
        $message->num   = $num_mesg ;
         $message->msg_date  = $request->msg_date ;
         $message->msg_title  = $request->msg_title ;
         $message->msg_subject  = $request->msg_subject;
         $message->msg_desc  = $request->msg_desc;
         $message->need_replay  = $request->need_replay;
         $message->replay_date  = $request->replay_date;
         $message->deleted_at  = $request->deleted_at;
         $message->doc_type_id   = $request->doc_type_id;
         $message->from_contact_id   = $request->from_contact_id;
         $message->priority_id   = $request->priority_id;
         $message->msg_type_id   = $request->msg_type_id;
       $message->rel_num_id     =  $request->rel_num_id  ;
      //  $message->forward_to_id     = $request->forward_to_id;
        $message->status_id     = $request->status_id;
       //dd($message->rel_num_id);
        $message->save();
       // dd($message->status_id);
       //  dd($message);
       // dd($request->msg_type_id);
        
 // dd($message->id);
    //  echo  $message->id;
        $message->sent_tos()->sync($request->input('sent_tos', []));
//        dd($request->input('forward_to', [])) ;
//        die();
       // $message->forward_to()->sync($request->input('forward_to', []));
        
           
        
      if (is_array($request->file('message_doc')) || is_object($request->file('message_doc'))){

        foreach($request->file('message_doc') as $file)
        {
            
            $media = DB::table('media')->where('model_id', $message->id)->get();
     $count_media = count($media)+1 ;     

            if($count_media<10){
           $num_file = $num_mesg.'-'."0".$count_media; 
        //  echo $num_file."<br>";
        // dd($num_file);
        }
        elseif($count_media >=10 && $count_media <=99)
        {
         $num_file = $num_mesg.'-'."".$count_media; 
           // echo $num_file."<br>";
          //   dd($num_file);
         }
            
          $full_name = $num_file.".".$file->getClientOriginalExtension();
   //    $path = $file->move(public_path()."\messages", $full_name) ; 
          // echo $path."<br>";
     // dd($path) ;
      //    $path2 =  public_path('\messages\/' . $full_name);
          //  echo $path2."<br>";
           // dd($path2) ;  
   //   $message->addMedia(public_path('\messages\/' . $full_name))->toMediaCollection('message_doc'); 
         //  echo $file;
           
    //  $file->move(public_path("messages"), $full_name);
            
    Storage::disk('fileStore')->putFileAs('messages', $file, $full_name);     
             //die();
            $media= new Mediaa();     
 //print_r($media);
            $media->name = $num_file;
            $media->model_type ="App\Message";
            $media->model_id = $message->id;
            $media->collection_name = "message_doc";
             $media->disk   = "public";
           // $media->size   = 1;//$file->getSize();
         //    $media->manipulations   = "qqq" ;
           // $media->custom_properties    = "oo";
            // $media->responsive_images    ="1";
            $media->file_name  = $full_name;
             $media->save();
          
         $file->move(public_path("messages"), $full_name);   
            
            
            
            
 
        }}
 foreach($message->media as $media)
{
    $url = $media->getFullUrl();
   //  echo $url."<br>";
}
        return redirect()->route('admin.messages.index'); 

    }
    
    
        public function editpost(Request $request)
            
        {
             abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
           // dd($request->ideditpost);
            $message = Message::find($request->ideditpost);
          //  echo $message;
                    $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::all()->pluck('priority_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

       // $rel_nums = Message::all()->pluck('num', 'id')->prepend(trans('global.pleaseSelect'), '');
        $rel_nums = Message::all()->pluck('FullName', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sent_tos = Contact::all()->pluck('contact_name', 'id');

        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $message->load('msg_type', 'doc_type', 'from_contact', 'priority', 'rel_num', 'sent_tos', 'forward_to');
     //echo $message;
         //echo $message->message_doc;
        return view('admin.messages.edit', compact('msg_types', 'doc_types', 'from_contacts', 'priorities', 'rel_nums', 'sent_tos', 'forward_tos', 'message'));
        }

    public function edit(Message $message)
    {
        abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::all()->pluck('priority_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

       // $rel_nums = Message::all()->pluck('num', 'id')->prepend(trans('global.pleaseSelect'), '');
        $rel_nums = Message::all()->pluck('FullName', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sent_tos = Contact::all()->pluck('contact_name', 'id');

        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $message->load('msg_type', 'doc_type', 'from_contact', 'priority', 'rel_num', 'sent_tos', 'forward_to');
     //echo $message;
         //echo $message->message_doc;
        return view('admin.messages.edit', compact('msg_types', 'doc_types', 'from_contacts', 'priorities', 'rel_nums', 'sent_tos', 'forward_tos', 'message'));
}

    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->all());
        $message->sent_tos()->sync($request->input('sent_tos', []));
        
          $num_mesg =   $request->num ;
        if (is_array($request->file('message_doc')) || is_object($request->file('message_doc'))){

        foreach($request->file('message_doc') as $file)
        {
            $media = DB::table('media')->where('model_id', $message->id)->get();
     $count_media = count($media)+1 ;     

            if($count_media<10){
           $num_file = $num_mesg.'-'."0".$count_media; 
        //  echo $num_file."<br>";
        // dd($num_file);
        }
        elseif($count_media >=10 && $count_media <=99)
        {
         $num_file = $num_mesg.'-'."".$count_media; 
           // echo $num_file."<br>";
          //   dd($num_file);
         }
            
          $full_name = $num_file.".".$file->getClientOriginalExtension();
    ///   $path = $file->move(public_path()."\messages", $full_name) ; 
          //  echo $path;
     // dd($path) ;
       ///   $path2 =  public_path('\messages\/' . $full_name);
           // dd($path2) ;  
    ///  $message->addMedia(public_path('\messages\/' . $full_name))->toMediaCollection('message_doc'); 
      $file->move(public_path("messages"), $full_name);
            
            $media= new Mediaa();     
 //print_r($media);
            $media->name = $num_file;
            $media->model_type ="App\Message";
            $media->model_id = $message->id;
            $media->collection_name = "message_doc";
             $media->disk   = "public";
           // $media->size   = 1;//$file->getSize();
         //    $media->manipulations   = "qqq" ;
           // $media->custom_properties    = "oo";
            // $media->responsive_images    ="1";
            $media->file_name  = $full_name;
             $media->save();

            
         
            
            
        }}
//        if (count($message->message_doc) > 0) {
//            foreach ($message->message_doc as $media) {
//                if (!in_array($media->file_name, $request->input('message_doc', []))) {
//                    $media->delete();
//                }
//
//            }
//
//        }
//
//        $media = $message->message_doc->pluck('file_name')->toArray();
//
//        foreach ($request->input('message_doc', []) as $file) {
//            if (count($media) === 0 || !in_array($file, $media)) {
//                $message->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('message_doc');
//            }
//
//        }

        return redirect()->route('admin.messages.index');

    }
    
    public function showpost(Request $request)
    {
         abort_if(Gate::denies('message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
          $message = Message::find($request->idshowpost);
                $message->load('msg_type', 'doc_type', 'from_contact', 'priority', 'rel_num', 'sent_tos', 'forward_to');

        return view('admin.messages.show', compact('message'));

        
    }

    public function show(Message $message)
    {
        abort_if(Gate::denies('message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $message->load('msg_type', 'doc_type', 'from_contact', 'priority', 'rel_num', 'sent_tos', 'forward_to');

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        abort_if(Gate::denies('message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $message->delete();

     //   return back();
 //   return redirect('http://172.23.101.27/INOUT/admin/messages');
 return redirect(asset('/admin/messages'));
    }

    public function massDestroy(MassDestroyMessageRequest $request)
    {
        Message::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('message_create') && Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Message();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }
    public function delete($id)
    {
        DB::delete('delete from media where id = ?',[$id]);

       // echo $id;
      return back();
    }
    
    
       public function needreplay()
        {
            
          $messages = Message::where('need_replay', '1')->get();
           // return $needreplay;

                 //   $messages = Message::all();
        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
  $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.messages.index', compact('messages','msg_types','from_contacts','forward_tos'));
          // return view('admin.messages.dashord');
         }
    
       public function exp()
        {
            
          $messages = Message::where('msg_type_id', '3')->orWhere('msg_type_id', '4')->get();
           // return $needreplay;

                 //   $messages = Message::all();
        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
  $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.messages.index', compact('messages','msg_types','from_contacts','forward_tos'));
          // return view('admin.messages.dashord');
         }
    
     public function emp()
        {
            
           $messages = Message::where('msg_type_id', '1')->orWhere('msg_type_id', '2')->get();
           // return $needreplay;

                 //   $messages = Message::all();
        $msg_types = MsgType::all()->pluck('msg_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
  $from_contacts = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $forward_tos = Contact::all()->pluck('contact_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.messages.index', compact('messages','msg_types','from_contacts','forward_tos'));
          // return view('admin.messages.dashord');
         }
    
    
    
    

}

      // dd($request);
//        $la =  DB::table('messages')->orderBy('id', 'desc')->first();
//echo $la->num ;
         

//       echo  "<br>".count($msg);
   
      //  Message::where('status', 1)->max('id');
        
        
     //   echo $num_mesg;
    //  $query = "select max(num) from  messages  where h2.name = h.name";
//      $query =  select max(num) from  messages ;
//      echo $query;  
        
//          $max_num = DB::table('messages')->max('num');
//          echo $max_num;
  //$user = Message::where('status', 1)->max('id');

        
        
//     $numRow =   Message::count()+1;
//        if($numRow<10){
//           $num_mesg = date('Y').'-'."0".$numRow.'-'."000".$numRow; 
//          //  echo $num_mesg;
//        }
//        elseif($numRow >=10 && $numRow <=99)
//        {
//         $num_mesg = date('Y').'-'."".$numRow.'-'."00".$numRow; 
//  
//        }
//        elseif($numRow >=100 && $numRow <=999 )
//        {
//          $num_mesg = date('Y').'-'."".$numRow.'-'."0".$numRow;  
//        }
//         elseif($numRow >=1000 && $numRow <=9999 )
//        {
//          $num_mesg = date('Y').'-'."".$numRow.'-'."".$numRow;  
//        }
  //  echo $m;
        
    
//       $message = Message::create($request->all());
//        
