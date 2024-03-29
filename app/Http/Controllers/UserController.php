<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\role_expire;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserPassRequest;

class UserController extends Controller
{
    public function index(){

        $users = user::all();

        return view('user.index',compact('users'));


    }

    public function create()
    {
        return view('user.create');
    }
    

    public function store(UserFormRequest $request)
    {
   
        $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255'
        ]);

        //return redirect('register')->withErrors('message', 'El usuario ya existe');

        $user = new User;
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->password);
        $user->save();


        return redirect('/users')->with('message','Usuario Agregado Exitosamente');
    }
    public function edit($user_id)
    {
        $user = User::find($user_id);

        return view('user.edit',compact('user'));
    }
    public function edit_pass($user_id)
    {
        $user = User::find($user_id);

        return view('user.change-password',compact('user'));
    }
    public function update_pass(UserPassRequest $request, $user_id){
        $data = $request->validated();

        $user =user::where('id', $user_id)->update([
           
            'password' => Hash::make($request->password),

        ]);
        return redirect('/users')->with('message','Contraseña Actualizado');
    }

    public function update(UserEditRequest $request, $user_id){
        $data = $request->validated();

        $user =user::where('id', $user_id)->update([
            'name' => $data['name'],
            'email' => $data['email'],

        ]);
        return redirect('/users')->with('message','Actualizado correctamente');
    }
    public function destroy($user_id){

        if($user = user::find($user_id)->hasRole('admin')){
            return back()->with('error','Admin no puede ser eliminado');
        }
        $user = user::find($user_id)->delete();
        return redirect('/users')->with('message','Usuario Eliminado');
    }

    /*public function destroy(User $user)
    {

        if($user->hasRole('admin')){
            return back()->with('message','Admin no puede ser eliminado');
        }

        $user->delete();
        
    }*/

    public function show(User $user)
    {
        $roles = Role::all();

        //$role_expire = role_expire::where('user_id', $user->id)->get();
        
        /*$timestamp = Carbon::now()->toDateTimeString();
        role_expire::where('role_expires.fechaexpiracion','<',$timestamp)->$user->syncRoles([]);
        */


        //role_expire::where('fechaexpiracion','<',Carbon::now())->delete();



        return view('user.role', compact('user', 'roles'));
    }

    public function assignRole(Request $request, User $user)
    {
        /*if($user->hasRole($request->role)){
            return back()->with('error','El Rol ya existe');
        }*/
       

        //condición para que el usuario pueda tener un solo Rol
        $user->loadCount('roles');
        if ($user->roles_count === 1)
        {

            return back()->with('error','El usuario ya posee un Rol');

        }
        
        //asignaRole
        $user->assignRole($request->role);

        return back()->with('message','Rol Asignado');

    }

    public function removeRole(User $user, Role $role)
    {
        if($user->hasRole($role)){
            $user->removeRole($role);
            return back()->with('message','Rol removido');
        }
        

        return back()->with('message','Rol no existe');
    }
}