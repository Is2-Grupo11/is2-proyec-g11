<?php

namespace App\Http\Controllers;

use App\Models\Stories;
use Illuminate\Http\Request;

class pruebaController extends Controller
{
    public function index ()
    {
        $storie = Stories::all();
        return view('dashboard', compact('storie'));
    }
}
