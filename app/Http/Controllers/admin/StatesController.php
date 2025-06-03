<?php

namespace App\Http\Controllers\admin;
use Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Http\Requests\StateRequest;
use App\Http\Requests\ProductRequest;

 

class StatesController extends Controller
{
    public function index()
    {
        $states = State::orderBy('id', 'desc')->paginate(12);
        return view('admin.states.index', ['states' => $states]);
    }

    public function create()
    {
        return view('admin.states.create');
    }

    public function store(StateRequest $request) 
    {
        $input = $request->all();      
        $state = State::create($input); 
        $request->session()->flash('success', 'State saved successfully!');
        return redirect()->route('states.index');
    }

    public function show(Product $state)
    {
        return $state->name;
    }

    public function edit(State $state)
    {
        return view('admin.states.edit', ['state' => $state]);
    }

    public function update(State $state, StateRequest $request) 
    {
        $state->update($request->all());
        $request->session()->flash('success', 'State updated successfully!');
        return redirect()->route('states.index');
    }

    public function destroy(Request $request, State $state)
    {
        $state->delete();
        $request->session()->flash('success', 'State deleted successfully!');
        return redirect()->route('states.index');
    }

    public function search(Request $request){
        $data = $request->input('search');
        $products = Product::where('name', 'like', "%$data%")->paginate(12);
 
        return view('admin.products.index', ['products'=>$products]);
    }






}