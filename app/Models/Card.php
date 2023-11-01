<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    const POSITION_GAP = 60000;
    const POSITION_MIN = 0.00002;
    protected $guarded =[];

    public static function booted()
    {
        static::creating(function($model) {
            $model->position = self::query()->where('board_list_id', $model->board_list_id)->orderByDesc('position')->first()?->position + self::POSITION_GAP;
        });

        static::saved(function($model) {

            if($model->position < self::POSITION_MIN) {
                DB::statement("SET @previousPosition := 0");
                DB::statement("
                    UPDATE cards
                    SET position = (@previousPosition := @previousPosition + ?)
                    WHERE board_list_id = ?
                    ORDER BY position
                ",[
                    self::POSITION_GAP,
                    $model->board_list_id
                ]);
            }

        });
    }

    public function sprint()
    {
        return $this->hasMany('App\Models\Sprint');
    }

    /*
    public function boards1()
    {
        return $this->hasMany('App\Models\BoardList');
    }*/
}
