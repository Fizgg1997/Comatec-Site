<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'pages';

    protected $fillable = [
        'id',
        'author_id',
        'title',
        'excerpt',
        'body',
        'image',
        'slug',
        'meta_description',
        'meta_keywords',
        'status',
        'created_at',
        'updated_at',
        'icon'
    ];

    protected $visible = [
        'id',
        'title',
        'body',
        'image',
        'slug',
        'status',
        'icon'
    ];


    public function scopeActive($query) {
        $query->where('status', 1);
    }
}
