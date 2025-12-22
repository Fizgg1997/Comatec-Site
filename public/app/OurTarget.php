<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class OurTarget extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'our_targets';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'image',
        'title',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $visible = [
        'id',
        'image',
        'title',
        'description'
    ];
}
