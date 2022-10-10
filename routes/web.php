<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\Admin\PermissionController; 
use App\Http\Controllers\BacklogController;
use App\Http\Controllers\BacklogProjectController;



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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

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

    Route::get('/users', 'index')->middleware(['role:admin']);  
    Route::get('/add-user', 'create')->middleware(['role:admin']);
    Route::post('/add-user', 'store')->middleware(['role:admin']);
    Route::get('/edit-user/{user_id}', 'edit')->middleware(['role:admin']);
    Route::put('/update-user/{user_id}', 'update')->middleware(['role:admin']);

    Route::get('/edit-pass/{user_id}', 'edit_pass')->middleware(['role:admin']);
    Route::put('/update-pass/{user_id}', 'update_pass')->middleware(['role:admin']);

    Route::delete('/delete-user/{user_id}', 'destroy')->middleware(['role:admin']);

});

Route::controller(App\Http\Controllers\ProjectController::class)->group(function () {


    Route::get('/projects', 'index');
    Route::post('/projects', 'store');

    Route::get('/project/{id}', 'edit'); 
    Route::put('/project/{id}', 'update');

    Route::delete('/project/{id}/', 'destroy');

});


Route::controller(ProjectUserController::class)->group(function () {


    Route::get('/project_user/{projects}', 'index');
    Route::post('/projects_user', 'store');
    Route::delete('/projects_user-delete/{id}', 'destroy');

});


Route::controller(App\Http\Controllers\BacklogController::class)->group(function () {


    Route::get('/backlogs', 'index');
    Route::post('/backlogs', 'store');

    Route::get('/backlog/{id}', 'edit'); 
    Route::put('/backlog/{id}', 'update');

    Route::delete('/backlog/{id}/', 'destroy');

});


Route::controller(BacklogProjectController::class)->group(function () {


    Route::get('/backlog_project/{backlogs}', 'index');
    Route::post('/backlogs_project', 'store');
    Route::delete('/backlogs_project-delete/{id}', 'destroy');

});
