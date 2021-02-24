<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Archive extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'archives';

    protected $appends = [
        'archive_doc',
    ];

    protected $dates = [
        'arc_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'notes',
        'arc_date',
        'arc_title',
        'created_at',
        'updated_at',
        'deleted_at',
        'doc_type_id',
        'arc_subject',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function getArcDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setArcDateAttribute($value)
    {
        $this->attributes['arc_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function doc_type()
    {
        return $this->belongsTo(DocType::class, 'doc_type_id');

    }

    public function getArchiveDocAttribute()
    {
        return $this->getMedia('archive_doc');

    }
}