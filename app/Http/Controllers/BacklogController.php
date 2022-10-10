<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Backlog;

use App\Models\BacklogProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BacklogController extends Controller
{
        public function index ()
    {
        $backlogs = Backlog::all();
        $backlogs_project = BacklogProject::all();
        //$project_user = ProjectUser::where('project_id', $projects->id)->get();
       //$projectu = Project::where('id', $projects_user->project_id)->get();
        return view('backlogs.index')->with(compact('backlogs','backlogs_project'));
    }

   
    public function edit($id)
    {
        $backlog = Backlog::find($id);
        return view('backlogs.edit')->with(compact('backlog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:backlogs|max:255'
        ]);
        //return redirect('/backlogs')->with('message', 'Este backlog ya existe');
        $this->validate($request, Backlog::$rules, Backlog::$messages);
        Backlog::create($request->all());

        return redirect('/backlogs')->with('message', 'Backlog creado correctamente');
        
    }

    public function update($id, Request $request)
    {
        //$this->validate($request, Project::$rules, Project::$messages);
        Backlog::find($id)->update($request->all());
        return redirect('/backlogs')->with('message', 'Backlog Editado correctamente');
    }

    public function destroy($id){

        
       // $user = user::find($user_id)->delete(); //prueba
        //Backlog::find($id)->delete();
        Backlog::destroy($id);
        return redirect('/backlogs')->with('message', 'Backlog Eliminado correctamente');
    }

}
