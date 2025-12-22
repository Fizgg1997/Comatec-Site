<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class OurTeam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'our_team';
    protected $dates = ['deleted_at'];

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
