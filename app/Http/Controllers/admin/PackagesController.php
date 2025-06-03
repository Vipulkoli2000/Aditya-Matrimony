<?php

namespace App\Http\Controllers\admin;

use Excel;
use Throwable;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Imports\ImportPackages;
use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;

class PackagesController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('id', 'desc')->paginate(12);
        return view('admin.packages.index', ['packages' => $packages]);
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(PackageRequest $request) 
    {
        $input = $request->all();      
        $package = Package::create($input); 
        $request->session()->flash('success', 'Package saved successfully!');
        return redirect()->route('packages.index'); 
    }
  
    public function show(Package $package)
    {
        return $package->name;
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', ['package' => $package]);
    }

    public function update(Package $package, PackageRequest $request) 
    {
        $package->update($request->all());
        $request->session()->flash('success', 'package updated successfully!');
        return redirect()->route('packages.index');
    }
  
    public function destroy(Request $request, Package $package)
    {
        $package->delete();
        $request->session()->flash('success', 'Package deleted successfully!');
        return redirect()->route('packages.index');
    }

    public function search(Request $request){
        $data = $request->input('search');
        $package = Package::where('name', 'like', "%$data%")->paginate(12);
 
        return view('admin.packages.index', ['packages'=>$packages]);
    }

    // Route::get('/import/user_profiles/', [PackagesController::class, 'import'])->name('packages.import');
    // Route::post('/import_user_profiles', [PackagesController::class, 'importPackagesExcel'])->name('packages.importPackagesExcel');

    public function import()
    {
        return view('admin.packages.import');
    }


    public function importPackagesExcel(Request $request)
    {
        try {
            Excel::import(new ImportPackages, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('packages.index');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

}