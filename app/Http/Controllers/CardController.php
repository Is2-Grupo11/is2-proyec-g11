<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\BoardList;
use App\Models\Card;
use App\Models\Sprint;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function move(Card $card)
    {
        request()->validate([
            'boardListId' => ['required', 'exists:board_lists,id'],
            'position' => ['required', 'numeric']
        ]);

        $card->update([
            'board_list_id' => request('boardListId'),
            'position' => round(request('position'), 5)

        ]);

        

        return redirect()->back();
    }

    public function index (Sprint $sprints)
    {
        //$stories = Stories::all();
        $stories = Card::where('sprint_id', $sprints->id)->get();
        $board = BoardList::where('sprint_id', $sprints->id)->get();
        return view('userstories.index')->with(compact('stories','sprints','board'));
    }

    public function edit($id)
    {
        $storie = Card::find($id);
        return view('userstories.edit')->with(compact('storie'));
    }
    public function store(Request $request)
    {

        //$this->validate($request, Stories::$rules, Stories::$messages);
        //Stories::create($request->all());
 
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        $project_id = $request->input('project_id');
        $backlog_id = $request->input('backlog_id');
        $sprint_id = $request->input('sprint_id');

       

        Card::create([
            'project_id' => $project_id,
            'backlog_id' => $backlog_id,
            'sprint_id' => $sprint_id,
            'board_list_id' =>$request->input('board_list_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);



        return back()->with('message', 'User Story creado correctamente');
        
    }

    public function update($id, Request $request)
    {
        Card::find($id)->update($request->all());
        return back()->with('message', 'User Storie editado correctamente');
    }

    public function destroy($id){

         Card::find($id)->delete();
         return back()->with('message', 'Eliminado correctamente');
     }
}
