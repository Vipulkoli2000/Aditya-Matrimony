<?php

namespace App\Http\Controllers\admin;

use App\Models\Block;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlocksController extends Controller
{
    public function index()
    {
        $blocks = Block::orderBy('id', 'desc')->paginate(12);
        return view('admin.blocks.index', ['blocks' => $blocks]);
    }

    public function create()
    {
        return view('admin.blocks.create');
    }

    public function store(Request $request) 
    {
        $input = $request->all();      
        $block = Block::create($input); 
        $request->session()->flash('success', 'Data saved successfully!');
        return redirect()->route('blocks.index'); 
    }
  
    public function show(Block $block)
    {
        return $block->name;
    }

    public function edit(Block $block)
    {
        return view('admin.blocks.edit', ['block' => $block]);
    }

    public function update(Block $block, Request $request) 
    {
        $block->update($request->all());
        $request->session()->flash('success', 'Data updated successfully!');
        return redirect()->route('blocks.index');
    }
  
    public function destroy(Request $request, Block $block)
    {
        $block->delete();
        $request->session()->flash('success', 'Data deleted successfully!');
        return redirect()->route('blocks.index');
    }

    public function search(Request $request){
        $data = $request->input('search');
        $blocks = Block::where('block', 'like', "%$data%")->paginate(12);
 
        return view('admin.blocks.index', ['blocks'=>$blocks]);
    }
   
}