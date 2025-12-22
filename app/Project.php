<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;
class Project extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $table = 'projects';
    protected $dates = ['deleted_at'];

    protected $translatable = [
        'title',
        'description',
        'summary',

    ];

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'summary',
        'created_at',
        'updated_at',
        'deleted_at',
        'inner_image'
    ];

    protected $visible = [
        'id',
        'title',
        'description',
        'image',
        'summary',
        'inner_image',
        'created_at',
    ];
}
