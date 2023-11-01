<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sprint;

use App\Models\Backlog;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BoardList;

class SprintController extends Controller
{
    public function index (Backlog $backlogs, Project $projects)
    {
        //$sprints = Sprint::all();


        
        $timestamp = Carbon::now()->toDateTimeString();
        Sprint::where('sprints.fechafin','<',$timestamp)
        ->update(['estado'=>'finalizado']);

        $sprints = Sprint::where('backlog_id', $backlogs->id, 'project_id', $projects->id)->get();
        return view('sprints.index')->with(compact('sprints','backlogs','projects'));

        
    }

    public function edit($id)
    {
        $sprint = Sprint::find($id);
        return view('sprints.edit')->with(compact('sprint'));
    }

    /* STORE DE ANTES
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:sprints|max:255'
        ]);

        $this->validate($request, Sprint::$rules, Sprint::$messages);
        Sprint::create($request->all());

        return redirect('/sprints')->with('message', 'Sprint creado correctamente');
        
    }
    */

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'fechainicio' => 'required',
            'fechafin' => 'required',
            'estado' => 'required|max:255',
            'numero' => 'required'
        ]);

        $project_id = $request->input('project_id');
        $backlog_id = $request->input('backlog_id');

        //guarda sprint
        /*$sprints = new Sprint();
        $sprints->project_id = $project_id;
        $sprints->backlog_id = $backlog_id;
        $sprints->name=$request->input('name');
        $sprints->fechainicio=$request->input('fechainicio');
        $sprints->fechafin=$request->input('fechafin');
        $sprints->estado=$request->input('estado');
        $sprints->numero=$request->input('numero');
        $sprints->save();*/

        $sprints =  Sprint::create([
            'project_id' => $project_id,
            'backlog_id' => $backlog_id,
            'name' => $request->input('name'),
            'fechainicio' => $request->input('fechainicio'),
            'fechafin' => $request->input('fechafin'),
            'estado' => $request->input('estado'),
            'numero' => $request->input('numero')

        ]);

            BoardList::create(['sprint_id' => $sprints->id, 'name' => 'To-do']);
            BoardList::create(['sprint_id' => $sprints->id, 'name' => 'Doing']);
            BoardList::create(['sprint_id' => $sprints->id, 'name' => 'Done']);
        
        

        return back()->with('message', 'Sprint creado correctamente');
        
    }

    public function update($id, Request $request)
    {
        $timestamp = Carbon::now()->toDateTimeString();
        Sprint::where('sprints.fechafin','<',$timestamp)
        ->update(['estado'=>'finalizado']);
        
        Sprint::find($id)->update($request->all());
        return back()->with('message', 'Sprint editado correctamente');
    }

    public function destroy($id){

        Sprint::destroy($id);
        return back()->with('message', 'Eliminado correctamente');
    
    }
    
    
}


