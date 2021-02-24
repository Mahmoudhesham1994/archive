<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Mediaa extends Model
{
    use SoftDeletes;

    public $table = 'media';

    protected $dates = [
        'created_at',
        'updated_at',
     ];

    protected $fillable = [
        'updated_at',
        'created_at',
        'model_type',
        'model_id',
        'collection_name',
        'name',
        'file_name',
        'mime_type',
        'disk',
        'size',
        'manipulations',
        'custom_properties',
        'responsive_images',
        'order_column',
     ];

   
}