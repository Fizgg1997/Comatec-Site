<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurIndustriesDetail extends Model
{
    use HasFactory;

    protected $table = 'our_industries_details';

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
