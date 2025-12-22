<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class AwardsAndCertificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'awards_and_certificates';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
        'title',
        'description',
        'type',
        'header_image',
        'slider_images'
    ];

    protected $visible = [
        'id',
        'image',
        'title',
        'description',
        'type',
        'header_image',
        'slider_images'
    ];
}
