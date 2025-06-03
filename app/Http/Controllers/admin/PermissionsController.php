<?php

namespace App\Http\Controllers\admin;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {   
        $permissions = Permission::orderBy('id', 'desc')->paginate(12);
        return view('admin.permissions.index', [
            'permissions' => $permissions
        ]);
    }

    public function create() 
    { 
        Artisan::call("permissions:generate");
        return redirect()->route('permissions.index');
    }

    public function store(Request $request)
    {   
       //
    }
    public function show(Permission $permission)
    {
        //
    }
   
    public function edit(Permission $permission)
    {
        //
    }

   
    public function update(Request $request, Permission $permission)
    {
        //
    }

    public function destroy(Request $request, Permission $permission)
    {
        //
    }
}
