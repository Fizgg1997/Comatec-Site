<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProjectsDetails extends Model
{
    use HasFactory;

    protected $table = 'projects_details';

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'summary',
        'created_at',
        'updated_at',
        'deleted_at',
        'inner_image',
        'project_date'
    ];

    protected $visible = [
        'id',
        'title',
        'description',
        'image',
        'summary',
        'inner_image',
        'created_at',
        'project_date'
    ];
}
