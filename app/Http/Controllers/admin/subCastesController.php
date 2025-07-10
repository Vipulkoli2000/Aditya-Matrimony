<?php

namespace App\Http\Controllers\admin;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCaste;
use App\Models\Caste;
use App\Http\Requests\subCasteRequest;

class subCastesController extends Controller
{
    public function index(Request $request)
    {
        $query = SubCaste::with('caste');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhereHas('caste', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
        }
        
        $sub_castes = $query->orderBy('id', 'desc')->paginate(12);
        return view('admin.sub_castes.index', ['sub_castes' => $sub_castes]);
    }

    public function create()
    {
        $castes = Caste::orderBy('name', 'asc')->get();
        return view('admin.sub_castes.create', ['castes' => $castes]);
    }

    public function store(subCasteRequest $request) 
    {
        $input = $request->all();      
        $sub_caste = SubCaste::create($input); 
        $request->session()->flash('success', 'SubCaste saved successfully!');
        return redirect()->route('sub_castes.index'); 
    }
  
    public function show(SubCaste $sub_caste)
    {
        return $sub_caste->name;
    }

    public function edit(SubCaste $sub_caste)
    {
        $castes = Caste::orderBy('name', 'asc')->get();
        return view('admin.sub_castes.edit', ['sub_caste' => $sub_caste, 'castes' => $castes]);
    }

    public function update(SubCaste $sub_caste, subCasteRequest $request) 
    {
        $sub_caste->update($request->all());
        $request->session()->flash('success', 'SubCaste updated successfully!');
        return redirect()->route('sub_castes.index');
    }
  
    public function destroy(Request $request, SubCaste $sub_caste)
    {
        $sub_caste->delete();
        $request->session()->flash('success', 'SubCaste deleted successfully!');
        return redirect()->route('sub_castes.index');
    }

    public function search(Request $request){
        $data = $request->input('search');
        $sub_castes = SubCaste::with('caste')
            ->where('name', 'like', "%$data%")
            ->orWhereHas('caste', function($query) use ($data) {
                $query->where('name', 'like', "%$data%");
            })
            ->paginate(12);
 
        return view('admin.sub_castes.index', ['sub_castes' => $sub_castes]);
    }}
