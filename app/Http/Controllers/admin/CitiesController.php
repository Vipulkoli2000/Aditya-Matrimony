<?php

namespace App\Http\Controllers\admin;
use Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Requests\CityRequest;
use App\Http\Requests\ProductRequest;


class CitiesController extends Controller
{

    public function index()
    {
        $cities = City::orderBy('id', 'desc')->paginate(12);
        return view('admin.cities.index', ['cities' => $cities]);
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(CityRequest $request) 
    {
        $input = $request->all();      
        $city = City::create($input); 
        $request->session()->flash('success', 'City saved successfully!');
        return redirect()->route('cities.index');
    }

    public function show(Product $city)
    {
        return $city->name;
    }

    public function edit(City $city)
    {
        return view('admin.cities.edit', ['city' => $city]);
    }

    public function update(City $city, CityRequest $request) 
    {
        $city->update($request->all());
        $request->session()->flash('success', 'City updated successfully!');
        return redirect()->route('cities.index');
    }

    public function destroy(Request $request, City $city)
    {
        $city->delete();
        $request->session()->flash('success', 'City deleted successfully!');
        return redirect()->route('cities.index');
    }

    public function search(Request $request){
        $data = $request->input('search');
        $products = Product::where('name', 'like', "%$data%")->paginate(12);
 
        return view('admin.products.index', ['products'=>$products]);
    }
}