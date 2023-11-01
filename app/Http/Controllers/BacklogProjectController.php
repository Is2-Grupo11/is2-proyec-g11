<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Backlog;
use App\Models\BacklogProject;
use Illuminate\Http\Request;



class BacklogProjectController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'project_id' => 'required|unique:backlog_project',
        ]);

        $backlog_id = $request->input('backlog_id');
        $project_id = $request->input('project_id');
        $backlog_project = BacklogProject::where('backlog_id', $backlog_id)->where('project_id', $project_id)->first();

        $backlog_project = new BacklogProject();
        $backlog_project->backlog_id = $backlog_id;
        $backlog_project->project_id = $project_id ;
        $backlog_project->save();

        return back()->with('message','Proyecto Asignado.');

    }

    public function index(Backlog $backlogs)
    {
        
        //$user = User::find()
        $projects = Project::all();
        $backlogs_project = BacklogProject::where('backlog_id', $backlogs->id)->get();
        return view('backlogs.project', compact('backlogs','projects','backlogs_project'));
    }

    public function destroy($id)
    {
        BacklogProject::destroy($id);
        //BacklogProject::find($id)->delete();
        //$deleteproject = BacklogProject::find($id);
        //$deleteproject->delete();
        return back()->with('message','Proyecto Removido.');
    }
}
