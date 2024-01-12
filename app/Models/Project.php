<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [

        'system_name',
        'bu_name',
        'system_pic',
        'start_date',
        'duration',
        'end_date',
        'status',
        'development_methodology',
        'system_platform',
        'deployment_type',
        'leader_developer_id',
        'system_id',
        'request_status',
    ];

    public function developers()
    {
        return $this->belongsToMany(Developer::class, 'developer_project');
    }

    public function leaderdeveloper()
    {
        return $this->belongsTo(Developer::class, 'leader_developer_id');
    }
}
