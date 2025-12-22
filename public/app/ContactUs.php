<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

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
