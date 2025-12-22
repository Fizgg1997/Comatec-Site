<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use TCG\Voyager\Traits\Translatable;
class OurIndustriesDetail extends Model
{
    use HasFactory, Translatable;

    protected $table = 'our_industries_details';


    protected $translatable = [
        'title',
        'description',
        'subtitles'
    ];


    protected $fillable = [
        'id',
        'business_id',
        'title',
        'description',
        'image',
        'subtitles',
        'created_at',
        'updated_at',
    ];

    protected $visible = [
        'id',
        'business_id',
        'title',
        'description',
        'image',
        'subtitles',
    ];
}
