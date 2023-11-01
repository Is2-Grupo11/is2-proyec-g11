<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Card;
use App\Models\Project;
use App\Models\Sprint;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        $projects = Project::all();
        
    return view('dashboard',compact('projects'));
    }
}
