<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'careers';
    protected $dates = ['deleted_at'];

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
