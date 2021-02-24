<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Message extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'messages';

//    protected $appends = [
//        'message_doc',
//    ];
    
    protected $appends = [
        'message_doc',
		'new_name'
    ];
     protected $casts = [
        'rel_num_id' => "integer"  
		 
    ];

    public function getNewNameAttribute()
{
	//return $this->msg_date.$this->msg_title;  
     return $this->msg_title;
}
    
    protected $dates = [
        'msg_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'replay_date',
    ];

    protected $fillable = [
        'id',
        'num',
        'msg_date',
        'msg_desc',
        'msg_title',
        'rel_num_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'msg_type_id',
        'doc_type_id',
        'msg_subject',
        'priority_id',
        'status_id',
        'need_replay',
        'replay_date',
        'forward_to_id',
        'from_contact_id',
       // 'new_title',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function getMsgDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setMsgDateAttribute($value)
    {
        $this->attributes['msg_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function msg_type()
    {
        return $this->belongsTo(MsgType::class, 'msg_type_id');

    }

    public function doc_type()
    {
        return $this->belongsTo(DocType::class, 'doc_type_id');

    }

    public function from_contact()
    {
        return $this->belongsTo(Contact::class, 'from_contact_id');

    }

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id');

    }
     public function status()
        {
            return $this->belongsTo(MsgStatus::class, 'status_id');

        }
    public function getReplayDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setReplayDateAttribute($value)
    {
        $this->attributes['replay_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function rel_num()
    {
        return $this->belongsTo(Message::class, 'rel_num_id');

    }

    public function sent_tos()
    {
        return $this->belongsToMany(Contact::class);

    }

    public function forward_to()
    {
         return $this->belongsToMany(Contact::class);
       // return $this->belongsTo(Contact::class, 'forward_to_id');

    }

    public function getMessageDocAttribute()
    {
        return $this->getMedia('message_doc');

    }
 
  
        public function getFullNameAttribute()
        {
            return "{$this->num} {$this->msg_title}";
        }


  /*  protected $appends = array('msg_title');

    public function getAvailabilityAttribute()
    {
            return $this->msg_title.' '.$this->msg_date

    }*/
//    protected $appends = array('availability');
//
//    public function getAvailabilityAttribute()
//    {
//        return $this->calculateAvailability();  
//    }


}