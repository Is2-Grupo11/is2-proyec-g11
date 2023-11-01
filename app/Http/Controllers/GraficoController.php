<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Project;
use App\Models\BoardList;
use Illuminate\Http\Request;

class GraficoController extends Controller
{
    public function index (Project $projects)
    {

        
        $backlogs = Backlog::where('project_id', $projects->id)->get();
        $boards = BoardList::all();

        
        return view('grafico',compact('projects','backlogs','boards'));
    }
}
