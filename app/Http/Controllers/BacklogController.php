<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Project;

use Illuminate\Http\Request;
use App\Models\BacklogProject;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BacklogController extends Controller
{
        public function index (Project $projects)
    {
        //$backlogs = Backlog::all();
        //$backlogs_project = BacklogProject::all();
        //$project_user = ProjectUser::where('project_id', $projects->id)->get();
       //$projectu = Project::where('id', $projects_user->project_id)->get();
        $backlogs = Backlog::where('project_id', $projects->id)->get();
        return view('backlogs.index', compact('projects','backlogs'));

        //return view('backlogs.index')->with(compact('backlogs','backlogs_project'));
    }

    //configurar acá para volver atrás correctamente en backlog
    public function edit($id)
    {
        $backlog = Backlog::find($id);
        //$backlogs = Backlog::where('project_id', $projects->id)->get();
        return view('backlogs.edit')->with(compact('backlog'));
    }


    //store original
    /*
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:backlogs|max:255'
        ]);
        //return redirect('/backlogs')->with('messages', 'Este backlog ya existe');
        $this->validate($request, Backlog::$rules, Backlog::$messages);
        Backlog::create($request->all());

        return redirect('/backlogs')->with('message', 'Backlog creado correctamente');
        
    }
    */

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'start' => 'required|max:255'
        ]);

        $project_id = $request->input('project_id');
        $backlogs = Backlog::where('project_id', $project_id)->first();

        //condición para que solo guarde 1 backlog por proyecto

        if ($backlogs)
        return back()->with('error','Ya existe backlog para este proyecto.');

        //guarda backlog

        $backlogs = new Backlog();
        $backlogs->project_id = $project_id;
        $backlogs->name=$request->input('name');
        $backlogs->description=$request->input('description');
        $backlogs->start=$request->input('start');
        $backlogs->save();

        return back()->with('message', 'Backlog creado correctamente');
        
    }


    public function update($id, Request $request)
    {
        //$this->validate($request, Project::$rules, Project::$messages);
        Backlog::find($id)->update($request->all());
        

        return back()->with('message', 'Backlog Editado correctamente');
    }

    public function destroy($id){

        
       // $user = user::find($user_id)->delete(); //prueba
        //Backlog::find($id)->delete();
        Backlog::destroy($id);
        return back()->with('message', 'Backlog Eliminado correctamente');
    }

}
