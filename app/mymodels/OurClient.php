<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Data;
class OurClient extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $table = 'our_clients';
    protected $dates = ['deleted_at'];

    protected $translatable = [
        'type'
    ];

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
