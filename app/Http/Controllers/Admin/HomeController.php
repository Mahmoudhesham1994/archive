<?php

namespace App\Http\Controllers\Admin;
use App\Message;
use App\Archive;
use Carbon\Carbon;
class HomeController
{
    public function index()
    {
     $need_replay =  Message::where('need_replay',1)
 ->get();
        $c_need_replay = count($need_replay);
        
        
          $msg_exp =  Message::wherein('msg_type_id',[3,4] )
            ->get();
        
        
        $c_msg_exp = count($msg_exp);
        
        $msg_import =  Message::wherein('msg_type_id',[1,2] )
            ->get();
        
        
        $msg_import_count = count($msg_import);
        
       $arch = Archive::whereMonth('created_at', Carbon::now()->month)
           ->get();
        
        $c_arch = count($arch);
     //  echo  $c_arch;
      //  echo $c_need_replay;
       // return view('home');
  return view('admin.messages.dashord', compact('c_need_replay','c_msg_exp','msg_import_count','c_arch'));

    }
    
    
    
    
    
}