<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
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

    public function project_user()
    {
        return $this->hasMany('App\Models\ProjectUser');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    //probando relación
    public function backlog1()
    {
        return $this->hasOne('App\Models\Backlog');
    }
}
