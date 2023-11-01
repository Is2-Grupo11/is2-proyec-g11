<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BacklogProject extends Model
{
    protected $table = 'backlog_project';

    public function backlog()
    {
        return $this->belongsTo('App\Models\Backlog');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
