<?php

namespace App\Http\Controllers\Admin;

use App\Archive;
use App\DocType;
 use App\Mediaa;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArchiveRequest;
use App\Http\Requests\StoreArchiveRequest;
use App\Http\Requests\UpdateArchiveRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArchivesController extends Controller
{
    use MediaUploadingTrait;
    public function search(Request $request)
    {
        
       if($request->date_from==""&$request->date_to==""&$request->arc_title==""&$request->doc_type_id==""&$request->arc_subject=="")
       {
                $archives = Archive::all();
          $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.archives.index', compact('archives','doc_types'));
   
       }
        else{
         $date_form = $request->date_from;
$date_to = $request->date_to;

 $arc_title = $request->arc_title;
 $doc_type_id = $request->doc_type_id;
$arc_subject = $request->arc_subject;
 $archives = Archive::wherehas('doc_type', function ($query) use ($doc_type_id)  {
$query->where("doc_type_id", $doc_type_id);
}) 
->Orwhere('arc_subject',$arc_subject)
->Orwhere('arc_title','like','%' .$arc_title.'%')
//->OrwhereBetween('arc_date', [$date_form, $date_to])
                          ->when(($request->date_from &&  $request->date_to), function($query) use ($request){
    $query->whereBetween('arc_date', [ $request->date_from,$request->date_to  ]);
})  

->get();
    $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');
           // dd($arc_title);
          //  dd($request);
// echo $archives;
      return view('admin.archives.index', compact('archives','doc_types'));
}
        
    }
    public function index()
    {
        abort_if(Gate::denies('archive_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $archives = Archive::all();
          $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.archives.index', compact('archives','doc_types'));
    }
    
    
      public function countmonth()
    {
        abort_if(Gate::denies('archive_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       // $archives = Archive::all();
        $archives =  Archive::whereMonth('created_at', Carbon::now()->month)
           ->get();
          $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.archives.index', compact('archives','doc_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('archive_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.archives.create', compact('doc_types'));
    }

    public function store(StoreArchiveRequest $request)
    {
      // dd($request);
        
        //  $archive = Archive::create($request->all());
       // echo $archive->id;
     
             $numRow =   Archive::count()+1;
        if($numRow<10){
           $num_arch = date('Y').'-'."00".'-'."000".$numRow; 
          //  echo $num_mesg;
        }
        elseif($numRow >=10 && $numRow <=99)
        {
         $num_arch = date('Y').'-'."00".'-'."00".$numRow; 
  
        }
        elseif($numRow >=100 && $numRow <=999 )
        {
          $num_arch = date('Y').'-'."00".'-'."0".$numRow;  
        }
         elseif($numRow >=1000 && $numRow <=9999 )
        {
          $num_arch = date('Y').'-'."00".'-'."".$numRow;  
        }

        
      $d =  $request->arc_date;
      $d2 =  "2013-03-15";
        $datee=date_create($d);

         $date2=date_create($d);
          // $date=date_create("2013-03-15");
           $date=date_create("16-04-2020");
     //   var_dump($date);
       // var_dump($d);
        // dd($d);
 //echo date_format($date,"d/m/Y");

        
         $archive = new Archive;
        $archive->num   = $num_arch ;
    //   $archive->arc_date   = date_format($d2,"d/m/Y") ;
       $archive->arc_date   = $request->arc_date;
        $archive->arc_title    = $request->arc_title ;
        $archive->arc_subject   = $request->arc_subject ;
        $archive->notes   = $request->notes ;
         $archive->doc_type_id    = $request->doc_type_id ;
        $archive->save();
        
    //     dd(date_format($datee,"d/m/Y"));
        
        
        
if (is_array($request->file('archive_doc')) || is_object($request->file('archive_doc'))){

        foreach($request->file('archive_doc') as $file)
            {
            
            
      $media = DB::table('media')->where('model_id', $archive->id)->get();
         //   echo  $media;
         //   echo $archive->id."<br>";
     $count_media = count($media)+1 ;     
    // echo $count_media."<br>";
            if($count_media<10){
           $num_file = $num_arch.'-'."0".$count_media; 
        //  echo $num_file."<br>";
        // dd($num_file);
        }
        elseif($count_media >=10 && $count_media <=99)
        {
         $num_file = $num_arch.'-'."".$count_media; 
           // echo $num_file."<br>";
          //   dd($num_file);
         }
 
            
            
            
//             $full_name = $num_file.".".$file->getClientOriginalExtension();
//             $file->move(public_path().'/archive/', $full_name); 
//             $archive->addMedia(public_path('/archive/' . $full_name))->toMediaCollection('archive_doc');
            
            
            
             $full_name = $num_file.".".$file->getClientOriginalExtension();
      // $path = $file->move(public_path()."\archive", $full_name) ; 
         //   echo $path."<br>";
      //dd($path) ;
 
 //         $path2 =  public_path('\archive\/' . $full_name);
         //  echo $path2."<br>";
           // dd($path2) ;  
    //  $archive->addMedia(public_path('\archive\/' . $full_name))->toMediaCollection('archive_doc'); 
         
      //$file->move(public_path("archive"), $full_name);
        Storage::disk('fileStore')->putFileAs('archives', $file, $full_name);        
        
            $media= new Mediaa();     
 //print_r($media);
            $media->name = $num_file;
            $media->model_type ="App\Archive";
            $media->model_id = $archive->id;
            $media->collection_name = "archive_doc";
             $media->disk   = "public";
           // $media->size   = 1;//$file->getSize();
         //    $media->manipulations   = "qqq" ;
           // $media->custom_properties    = "oo";
            // $media->responsive_images    ="1";
            $media->file_name  = $full_name;
             $media->save();
        // echo "success";
            $file->move(public_path("archive"), $full_name);
            
       
            
//          $full_name = $num_file.".".$file->getClientOriginalExtension();
//       $path = $file->move(public_path()."\uploads", $full_name) ; 
//          //  echo $path;
//     // dd($path) ;
//          $path2 =  public_path('\uploads\/' . $full_name);
//           // dd($path2) ;  
//      $message->addMedia(public_path('\uploads\/' . $full_name))->toMediaCollection('message_doc'); 

      
      
        }}
          return redirect()->route('admin.archives.index');
    }

    
            public function editpost(Request $request)
            
        {
            abort_if(Gate::denies('archive_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
           // dd($request->ideditpost);
            $archive = Archive::find($request->ideditpost);

                        $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $archive->load('doc_type');
      //  echo $archive;

//echo $archive->archive_doc;
        return view('admin.archives.edit', compact('doc_types', 'archive'));

            }
    public function edit(Archive $archive)
    {
        abort_if(Gate::denies('archive_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doc_types = DocType::all()->pluck('doc_type_desc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $archive->load('doc_type');
      //  echo $archive;

//echo $archive->archive_doc;
        return view('admin.archives.edit', compact('doc_types', 'archive'));
    }

    public function update(UpdateArchiveRequest $request, Archive $archive)
    {
        $archive->update($request->all());
         $num_arch =   $request->num ;
if (is_array($request->file('archive_doc')) || is_object($request->file('archive_doc'))){
          foreach($request->file('archive_doc') as $file)
            {
            
            
      $media = DB::table('media')->where('model_id', $archive->id)->get();
         //   echo  $media;
         //   echo $archive->id."<br>";
     $count_media = count($media)+1 ;     
     echo $count_media."<br>";
            if($count_media<10){
           $num_file = $num_arch.'-'."0".$count_media; 
        //  echo $num_file."<br>";
        // dd($num_file);
        }
        elseif($count_media >=10 && $count_media <=99)
        {
         $num_file = $num_arch.'-'."".$count_media; 
           // echo $num_file."<br>";
          //   dd($num_file);
         }
              
             $full_name = $num_file.".".$file->getClientOriginalExtension();
       $path = $file->move(public_path()."\archive", $full_name) ; 
            echo $path."<br>";
     // dd($path) ;
          $path2 =  public_path('\archive\/' . $full_name);
         //  echo $path2."<br>";
           // dd($path2) ;  
      $archive->addMedia(public_path('\archive\/' . $full_name))->toMediaCollection('archive_doc'); 
         
       
        } 
        }
        
        
        
 
//        if (count($archive->archive_doc) > 0) {
//            foreach ($archive->archive_doc as $media) {
//                if (!in_array($media->file_name, $request->input('archive_doc', []))) {
//                    $media->delete();
//                }
//
//            }
//
//        }
//
//        $media = $archive->archive_doc->pluck('file_name')->toArray();
//
//        foreach ($request->input('archive_doc', []) as $file) {
//            if (count($media) === 0 || !in_array($file, $media)) {
//                $archive->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('archive_doc');
//            }
//
//        }

        return redirect()->route('admin.archives.index');

    }
    
        public function showpost(Request $request)
    {
        abort_if(Gate::denies('archive_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
          $archive = Archive::find($request->idshowpost);
                    $archive->load('doc_type');

        return view('admin.archives.show', compact('archive'));


        }

    public function show(Archive $archive)
    {
        abort_if(Gate::denies('archive_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $archive->load('doc_type');

        return view('admin.archives.show', compact('archive'));
    }

    public function destroy(Archive $archive)
    {
        //dd($archive);
        abort_if(Gate::denies('archive_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $archive->delete();
//dd(back());
     //   return back();
    return redirect('http://172.23.101.27/INOUT/admin/archives');

    }

    public function massDestroy(MassDestroyArchiveRequest $request)
    {
        Archive::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('archive_create') && Gate::denies('archive_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Archive();
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
    
    public function show_two()
    {
       return view('admin.archives.show_two'); 
    }
   

}


      //  $media= new Mediaa();     
       // print_r($media);
//            $media->name = $num_file;
//            $media->model_type ="App\Archive";
//            $media->model_id = $archive->id;
//            $media->collection_name = "1";
//             $media->disk   = "public";
//            $media->size   = 1;//$file->getSize();
//            $media->manipulations   = [] ;
//            $media->custom_properties    = "";
//             $media->responsive_images    ="1";
//            $media->file_name  = $full_name;
//            $media->save();
          //   echo "success";









//dd($request) ;
//        foreach ($request->input('archive_doc', []) as $file) {
//            echo $file;
//         //   $archive->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('archive_doc');
//        }
//
//        if ($media = $request->input('ck-media', false)) {
//            Media::whereIn('id', $media)->update(['model_id' => $archive->id]);
//        }

     //   return redirect()->route('admin.archives.index');
        /*
      //  $archive = Archive::create($request->all());
        $archive = Archive::create($request->except(['archive_doc']));
//$input = $request->except(['credit_card']);

        foreach ($request->archive_doc as $file) {
               $numRow =   DB::table('media')->count()+1;
            // echo $numRow."<br>";
        if($numRow<10){
           $num_file = date('Y').'-'."0".$numRow.'-'."000".$numRow.'-'."0".$numRow; 
          echo $num_file."<br>";
        }
        elseif($numRow >=10 && $numRow <=99)
        {
         $num_file = date('Y').'-'."".$numRow.'-'."00".$numRow.'-'."".$numRow; 
            echo $num_file."<br>";
         }
        elseif($numRow >=100 && $numRow <=999 )
        {
          $num_file = date('Y').'-'."".$numRow.'-'."0".$numRow.'-'."".$numRow;  
           echo $num_file."<br>";
        }
         elseif($numRow >=1000 && $numRow <=9999 )
        {
          $num_file = date('Y').'-'."".$numRow.'-'."".$numRow.'-'."".$numRow;  
          echo $num_file."<br>";
        }
           $filee = 'tmp/uploads/' . $file ; 
            $ext = pathinfo($filee); 
             $full_file = $num_file.".".$ext['extension'];
            
   echo $full_file;
            
            
      // $extension = $full_file->getClientOriginalExtension();
            $extension = $ext['extension'];
            dd($file);
//dd($num_file);
    $url =   Storage::putFileAs('public/tmp/uploads',$file , $full_file);
  //  $url =  Storage::disk('public')->put(strtolower($full_file), $file);
       
  dd($url);
            
            
 
            
            
            
        //   $archive->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('archive_doc');
//       $archive->addMedia(storage_path('tmp/uploads/' . $full_file))->toMediaCollection('archive_doc');      
//          $fileName = 'name.'.$request->file->extension();  
//   
//        $request->file->move(storage_path('uploads'), $fileName);
  
          //$archive->addMedia(storage_path('tmp/uploads/'.$num_file . $file))->toMediaCollection('archive_doc');
            
 
             // $ext = pathinfo($file);
           // echo $ext['dirname']."dddd" . '<br/>';
 
          //  echo $filee."<br>";
            //echo $ext['dirname'] . '<br/>'; 
            // Returns folder/directory echo $ext['basename'] . '<br/>'; // Returns file.html echo $ext['extension'] . '<br/>'; // Returns .html echo $ext['filename'] . '<br/>


        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $archive->id]);
        }

       return redirect()->route('admin.archives.index');
*/





           //   echo $file->getSize()."<br>";
         //   $name= $file->getClientOriginalName();
          //  $file->move(public_path().'/files/', $name); 
           // echo $name."<br>";
//            $numRow =   DB::table('media')->count()+1;
//            // echo $numRow."<br>";
//        if($numRow<10){
//           $num_file = date('Y').'-'."0".$numRow.'-'."000".$numRow.'-'."0".$numRow; 
//        //  echo $num_file."<br>";
//        }
//        elseif($numRow >=10 && $numRow <=99)
//        {
//         $num_file = date('Y').'-'."".$numRow.'-'."00".$numRow.'-'."".$numRow; 
//           // echo $num_file."<br>";
//         }
//        elseif($numRow >=100 && $numRow <=999 )
//        {
//          $num_file = date('Y').'-'."".$numRow.'-'."0".$numRow.'-'."".$numRow;  
//        //   echo $num_file."<br>";
//        }
//         elseif($numRow >=1000 && $numRow <=9999 )
//        {
//          $num_file = date('Y').'-'."".$numRow.'-'."".$numRow.'-'."".$numRow;  
//         // echo $num_file."<br>";
//        }
