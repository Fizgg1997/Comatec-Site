<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;
class Header extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $table = 'header';
    protected $dates = ['deleted_at'];

    protected $translatable = [
        'title',
        'description',
    ];
    
    protected $fillable = [
        'id',
        'background_image',
        'title',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $visible = [
        'id',
        'background_image',
        'title',
        'description',
    ];
}
