<?php

namespace App\Models;

use App\Models\BoardList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sprint extends Model
{
    public static $rules=[
        'name'=>'required',
        'fechainicio' => 'required',
        'fechafin' => 'required',
        'estado'=>'required',
        'numero'=>'required'
    ];
    public static $messages = [
        
        'fechafin.required' => 'Fecha obligatoria.',
        
    ];

   /* protected $fillable = [
        'name','fechainicio', 'fechafin','estado','numero'
    ];*/

    protected $guarded = [];

    public function backlog()
    {
        return $this->hasMany('App\Models\Backlog');
    }

    public function lists(): HasMany
    {
        return $this->hasMany(BoardList::class);
    }

      //probando relación
      public function card1()
      {
          return $this->hasMany('App\Models\Card');
      }
}
