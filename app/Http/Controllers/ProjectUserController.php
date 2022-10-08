<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    public function store(Request $request)
    {
        $project_id = $request->input('project_id');
        $user_id = $request->input('user_id');
        $project_user = ProjectUser::where('project_id', $project_id)->where('user_id', $user_id)->first();

        if ($project_user)
        return back()->with('error','El usuario ya esta asignado a este Proyecto.');

        $project_user = new ProjectUser();
        $project_user->project_id = $project_id;
        $project_user->user_id = $user_id ;
        $project_user->save();

        return back()->with('message','Usuario Asignado.');

    }

    public function index(Project $projects)
    {
        
        //$user = User::find()
        $users = User::all();
        $projects_user = ProjectUser::where('project_id', $projects->id)->get();
        return view('projects.user', compact('projects','users','projects_user'));
    }

    public function destroy($id)
    {
        ProjectUser::find($id)->delete();
        return back()->with('message','Usuario Removido.');
    }
}
