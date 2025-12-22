<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class OurIndustry extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'our_industries';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
        'inner_image',
        'summary',
        'icon',
        'color',
        'sub_title',
    ];

    protected $visible = [
        'id',
        'title',
        'description',
        'image',
        'inner_image',
        'summary',
        'icon',
        'color',
        'sub_title'
    ];
}
