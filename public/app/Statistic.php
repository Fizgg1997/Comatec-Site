<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Statistic extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'statistics';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'icon',
        'achievement_number',
        'title',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $visible = [
        'id',
        'icon',
        'achievement_number',
        'title'
    ];
}
