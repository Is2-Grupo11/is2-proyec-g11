<?php

use Inertia\Inertia;
use App\Models\Stories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\pruebaController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\BacklogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\BacklogProjectController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraficoController;
use App\Models\Card;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/dashboard', function () {
    $stories = Stories::all();
    $projects = Project::all();
    $card = Card::where('project_id', $projects->id)->get();
    return view('dashboard',compact('stories'));
})->middleware(['auth'])->name('dashboard');
*/

Route::controller(GraficoController::class)->group(function () {


    Route::get('/grafico/{projects}', 'index');

});

Route::controller(DashboardController::class)->group(function () {


    Route::get('/dashboard/', 'index')->middleware(['auth'])->name('dashboard');

});


Route::middleware(['auth','role:admin'])->name('admin.')->prefix('admin')->group(function(){

    Route::get('/',[IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class,'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class,'removeRole'])->name('permissions.roles.remove');
    Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/roles',[UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}',[UserController::class, 'removeRole'])->name('users.roles.remove');
    

   
});

require __DIR__.'/auth.php';

Route::controller(App\Http\Controllers\UserController::class)->group(function () {

    Route::get('/users', 'index')->middleware(['permission:read'])->name('users');  
    Route::get('/add-user', 'create')->middleware(['permission:create']);
    Route::post('/add-user', 'store')->middleware(['permission:create']);
    Route::get('/edit-user/{user_id}', 'edit')->middleware(['permission:update']);
    Route::put('/update-user/{user_id}', 'update')->middleware(['permission:update']);

    Route::get('/edit-pass/{user_id}', 'edit_pass')->middleware(['permission:update']);
    Route::put('/update-pass/{user_id}', 'update_pass')->middleware(['permission:update']);

    Route::delete('/delete-user/{user_id}', 'destroy')->middleware(['permission:delete']);

});

Route::controller(App\Http\Controllers\ProjectController::class)->group(function () {


    Route::get('/projects', 'index')->middleware(['permission:read'])->name('projects');
    Route::post('/projects', 'store')->middleware(['permission:create']);

    Route::get('/project/{id}', 'edit')->middleware(['permission:update']); 
    Route::put('/project/{id}', 'update')->middleware(['permission:update']);

    Route::delete('/project/{id}/', 'destroy')->middleware(['permission:delete']);

});


Route::controller(ProjectUserController::class)->group(function () {


    Route::get('/project_user/{projects}', 'index')->middleware(['permission:read']);
    Route::post('/projects_user', 'store')->middleware(['permission:create']);
    Route::delete('/projects_user-delete/{id}', 'destroy')->middleware(['permission:delete']);

});


Route::controller(App\Http\Controllers\BacklogController::class)->group(function () {


    Route::get('/backlogs/{projects}', 'index')->name('backlog.index')->middleware(['permission:read']);
    Route::post('/backlogs', 'store')->middleware(['permission:create']);

    Route::get('/backlog/{id}', 'edit')->middleware(['permission:update']); 
    Route::put('/backlog/{id}', 'update')->middleware(['permission:update']); 

    Route::delete('/backlog/{id}/', 'destroy')->middleware(['permission:delete']);

});


Route::controller(BacklogProjectController::class)->group(function () {


    Route::get('/backlog_project/{backlogs}', 'index');
    Route::post('/backlogs_project', 'store');
    Route::delete('/backlogs_project-delete/{id}', 'destroy');

});
Route::controller(CardController::class)->group(function () {


    Route::get('/stories/{sprints}', 'index')->middleware(['permission:read']);
    Route::post('/stories', 'store')->middleware(['permission:create']);

    Route::get('/storie_edit/{id}', 'edit')->middleware(['permission:update']); 
    Route::put('/storie/{id}', 'update')->middleware(['permission:update']); 

    Route::delete('/storie/{id}/', 'destroy')->middleware(['permission:delete']); 


    Route::put('/cards/{card}/move', 'move')->name('cards.move')->middleware(['permission:update']);;

    

});


Route::controller(App\Http\Controllers\SprintController::class)->group(function () {


    Route::get('/sprints/{backlogs}', 'index')->middleware(['permission:read']); 
    Route::post('/sprints', 'store')->middleware(['permission:create']); 

    Route::get('/sprint/{id}', 'edit')->middleware(['permission:update']); 
    Route::put('/sprint/{id}', 'update')->middleware(['permission:update']);

    Route::delete('/sprint/{id}/', 'destroy')->middleware(['permission:delete']); 

});

Route::get('/boards/{board}', [BoardController::class, 'show'])->middleware(['permission:read']);//->middleware('auth'); ver para autenticar el logueo