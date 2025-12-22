<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoteImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'promote_images';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'images',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $visible = [
        'id',
        'images',
    ];
}
