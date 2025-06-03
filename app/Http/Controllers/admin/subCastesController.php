<?php

namespace App\Http\Controllers\admin;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCaste;
use App\Http\Requests\subCasteRequest;
use App\Http\Requests\ProductRequest;



class subCastesController extends Controller
{
    public function index()
    {
        $sub_castes = SubCaste::orderBy('id', 'desc')->paginate(12);
        return view('admin.sub_castes.index', ['sub_castes' => $sub_castes]);
    }

    public function create()
    {
        return view('admin.sub_castes.create');
    }

    public function store(subCasteRequest $request) 
    {
        $input = $request->all();      
        $sub_caste = SubCaste::create($input); 
        $request->session()->flash('success', 'SubCaste saved successfully!');
        return redirect()->route('sub_castes.index'); 
    }
  
    public function show(Product $sub_cast)
    {
        return $sub_cast->name;
    }

    public function edit(SubCaste $sub_caste)
    {
        return view('admin.sub_castes.edit', ['sub_caste' => $sub_caste]);
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
        $products = Product::where('name', 'like', "%$data%")->paginate(12);
 
        return view('products.index', ['products'=>$products]);
    }}