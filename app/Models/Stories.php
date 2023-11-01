<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    public static $rules=[
        'name' => 'required',
        'description' => 'required',
    ];
    public static $messages = [
        'name.required' => 'Requiere Nombre.',
        'description.required' => 'Descripcion obligatoria.',
        
    ];

    protected $fillable = [
        'name', 'description','priori'
    ];

    public function sprint()
    {
        return $this->hasMany('App\Models\Sprint');
    }

}
