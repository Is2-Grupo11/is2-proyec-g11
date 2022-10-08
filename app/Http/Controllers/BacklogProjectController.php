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
        $backlog_id = $request->input('backlog_id');
        $projectb_id = $request->input('projectb_id');
        $backlog_project = BacklogProject::where('backlog_id', $backlog_id)->where('projectb_id', $projectb_id)->first();

        if ($backlog_project)
        return back()->with('error','El projecto ya esta asignado a este Backlog.');

        $backlog_project = new BacklogProject();
        $backlog_project->backlog_id = $backlog_id;
        $backlog_project->projectb_id = $projectb_id ;
        $backlog_project->save();

        return back()->with('message','Projecto Asignado.');

    }

    public function index(Backlog $backlogs)
    {
        
        $projects = Project::all();
        $backlogs_project = BacklogProject::where('backlog_id', $backlogs->id)->get();
        return view('backlogs.project', compact('backlogs','projects','backlogs_project'));
    }

    public function destroy($id)
    {
        BacklogProject::find($id)->delete();
        return back()->with('message','Projecto Removido.');
    }
}
