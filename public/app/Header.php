<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Header extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'header';
    protected $dates = ['deleted_at'];
    
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
