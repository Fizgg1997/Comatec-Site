<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projects';
    protected $dates = ['deleted_at'];

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
