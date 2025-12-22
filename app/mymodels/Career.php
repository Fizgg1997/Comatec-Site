<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;

class Career extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $table = 'careers';
    protected $dates = ['deleted_at'];

     protected $translatable = [
        'name',
        'message',
    ];


    protected $fillable = [
        'id',
        'name',
        'mobile_number',
        'email',
        'message',
        'file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $visible = [
        'id',
        'name',
        'mobile_number',
        'email',
        'message',
        'file',
    ];
}
