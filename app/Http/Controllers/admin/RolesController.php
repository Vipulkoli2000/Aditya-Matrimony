<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{   
    public function index()
    {          
        $roles = Role::paginate(12);
        $permissions = Permission::all();
        return view('admin.roles.index',compact('roles','permissions'));
    }
    
    public function create()
    {
        $permissions = Permission::get();
        // dd($permissions);
        return view('admin.roles.create', compact('permissions'));
    }
      
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required',
        ]);
        $input = $request->all();        
        $role = Role::create($input);
        $data = $role->syncPermissions($request->permission);
        $request->session()->flash('success', 'Roles saved successfully!');
        return redirect()->route('roles.index');
    }
   
    public function show(Role $role)
    {
       //
    }

    public function edit(Role $role)
    {    
        return view('admin.roles.edit', [
            'role' => $role,
            'rolePermissions' => $role->permissions->pluck('name')->toArray(),
            'permissions' => Permission::get(),
        ]);
    }   
       
    public function update(Role $role, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required',
        ]);    
        $input = $request->all();
        $role->update($input);
        $data = $role->syncPermissions($request->permission);
        $request->session()->flash('success', 'Role updated successfully!');
        return redirect()->route('roles.index');       
    }

    public function destroy(Request $request, Role $role)
    {
        $role->delete();
        $request->session()->flash('success', 'Role deleted successfully!');
        return redirect()->route('roles.index');
    }
}
