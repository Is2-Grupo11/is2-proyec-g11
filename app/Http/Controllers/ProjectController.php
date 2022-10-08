<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
        public function index ()
    {
        $projects = Project::all();
        $projects_user = ProjectUser::all();
        //$project_user = ProjectUser::where('project_id', $projects->id)->get();
       //$projectu = Project::where('id', $projects_user->project_id)->get();
        return view('projects.index')->with(compact('projects','projects_user'));
    }

   
    public function edit($id)
    {
        $project = Project::find($id);
        return view('projects.edit')->with(compact('project'));
    }

    public function store(Request $request)
    {

        $this->validate($request, Project::$rules, Project::$messages);
        Project::create($request->all());

        return redirect('/projects')->with('message', 'Proyecto creado correctamente');
        
    }

    public function update($id, Request $request)
    {
        //$this->validate($request, Project::$rules, Project::$messages);
        Project::find($id)->update($request->all());
        return redirect('/projects')->with('message', 'Proyecto Editado correctamente');
    }

    public function destroy($id){

        
       // $user = user::find($user_id)->delete(); //prueba
        Project::find($id)->delete();
        return redirect('/projects')->with('message', 'Proyecto Eliminado correctamente');
    }

}
