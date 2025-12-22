<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;
class NewsAndArticle extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $table = 'news_and_articles';
    protected $dates = ['deleted_at'];

    protected $translatable = [
        'title',
        'description',
        'summary'
    ];

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
        'date',
        'summary'
    ];

    protected $visible = [
        'id',
        'title',
        'description',
        'image',
        'date',
        'summary'
    ];
}
