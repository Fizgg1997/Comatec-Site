<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;
class OurTeam extends Model
{
    use HasFactory, SoftDeletes,Translatable;

    protected $table = 'our_team';
    protected $dates = ['deleted_at'];


    protected $translatable = [
        'name',
        'job_title',
    ];

    protected $fillable = [
        'id',
        'name',
        'image',
        'job_title',
        'created_at',
        'updated_at',
        'deleted_at',
        'linkedIn_account'
    ];

    protected $visible = [
        'id',
        'name',
        'image',
        'job_title',
        'linkedIn_account'
    ];
}
