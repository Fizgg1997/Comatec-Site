<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;

class AwardsAndCertificate extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $table = 'awards_and_certificates';
    protected $dates = ['deleted_at'];

    /**
     * Tell Voyager which columns are translatable
     */
    protected $translatable = [
        'title',
        'description',
        'type',
    ];

    // Only keep user-editable columns in fillable
    protected $fillable = [
        'title',
        'description',
        'type',
        'image',
        'header_image',
        'slider_images',
    ];

    protected $visible = [
        'id',
        'title',
        'description',
        'type',
        'image',
        'header_image',
        'slider_images',
    ];
}
