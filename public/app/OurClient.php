<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class OurClient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'our_clients';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'logo',
        'created_at',
        'updated_at',
        'deleted_at',
        'type'
    ];

    protected $visible = [
        'id',
        'logo',
        'type'
    ];
}
