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
        return view('backlogs.index')->with(compact('backlogs','backlogs_project'));
    }

   
    public function edit($id)
    {
        $backlog = Backlog::find($id);
        return view('backlogs.edit')->with(compact('backlog'));
    }

    public function store(Request $request)
    {

        $this->validate($request, Backlog::$rules, Backlog::$messages);
        Backlog::create($request->all());

        return redirect('/backlogs')->with('message', 'Backlog creado correctamente');
        
    }

    public function update($id, Request $request)
    {
        Backlog::find($id)->update($request->all());
        return redirect('/backlogs')->with('message', 'Backlog Editado correctamente');
    }

    public function destroy($id){
        Backlog::find($id)->delete();
        return redirect('/backlogs')->with('message', 'Backlog Eliminado correctamente');
    }

}
