<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;

class ContactUs extends Model
{
    use HasFactory,  Translatable;

    protected $table = 'contact_us';
    protected $dates = ['deleted_at'];

    protected $translatable = [
        'name',
        'note',
        'mobile_number',
    ];

    protected $fillable = [
        'id',
        'name',
        'mobile_number',
        'email',
        'note'
    ];

    protected $visible = [
        'id',
        'name',
        'mobile_number',
        'email',
        'note'
    ];
}
