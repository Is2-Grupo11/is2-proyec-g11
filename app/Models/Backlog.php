<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{

    public static $rules=[
        'name' => 'required',
        //'description' => '',
        'start' => 'date'
    ];
    public static $messages = [
        'name.required' => 'Requiere Nombre.',
        'start.date' => 'La fecha no tiene formato adecuado.'
    ];

    protected $fillable = [
        'name', 'description', 'start'
    ];


    //PRUEBA DE RELACIONES

    public function backlog_project()
    {
        return $this->hasMany('App\Models\BacklogProject');
    }

    public function project()
    {
        return $this->hasMany('App\Models\Project');
    }
}
