<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required','min:3']]);
        Role::create($validated);

        return to_route('admin.roles.index')->with('message', 'Rol Creado Correctamente');

    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required','min:3']]);
        $role->update($validated);
        return to_route('admin.roles.index')->with('message', 'Rol Actualizado Correctamente');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        
        return back()->with('message','Rol Eliminado Correctamente');
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message','El permiso ya existe');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message','Permiso Agregado');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permiso revocado');
        }
        return back()->with('message','Permiso no existe');
    }
}
