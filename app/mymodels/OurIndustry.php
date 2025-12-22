<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;

class OurIndustry extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $table = 'our_industries';
    protected $dates = ['deleted_at'];

    /**
     * Tell Voyager which columns are translatable.
     * (Only text-ish fields should go here.)
     */
    protected $translatable = [
        'title',
        'sub_title',
        'summary',
        'description',
    ];

    // You don’t need id/created_at/updated_at/deleted_at in fillable
    protected $fillable = [
        'title',
        'description',
        'image',
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
        'sub_title',
    ];
}
