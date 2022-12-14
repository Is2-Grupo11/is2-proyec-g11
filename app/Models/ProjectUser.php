<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $table = 'project_user';

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
