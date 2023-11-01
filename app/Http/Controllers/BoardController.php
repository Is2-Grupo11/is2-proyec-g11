<?php

namespace App\Http\Controllers;

use App\Models\BoardList;
use App\Models\Card;
use App\Models\Sprint;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /*
    public function show(){
        $board = BoardList::all();
        //$card = Card::all();
        $board->load([
            'cards' => fn($query) => $query->orderBy('position')
        ]);
        
        return Inertia::render('Board',[
            'board' => $board
            //,'card' => $card
        ]);
    }*/

    public function show(Sprint $board){

        /*$board->load([
            'cards' => fn($query) => $query->orderBy('position')
        ]);*/
        

        //PROBAR ESTA RELACIÓN
        $board->load([
            'lists.cards' => fn($query) => $query->orderBy('position')
        ]);
        

        return Inertia::render('Board',[
            'board' => $board
        ]);
    }



}