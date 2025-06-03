<?php

namespace App\Http\Controllers\admin;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('id', 'desc')->paginate(12);
        return view('admin.pages.index', ['pages' => $pages]);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'title' => 'required|string|unique:pages,title',
            'layout' => 'required',

        ]);
        
        $input = $request->all();   
        $title = $input['title'];
        $slug = Str::slug($title, '-'); 
        $input['slug'] = $slug;
        $page = Page::create($input); 
        $request->session()->flash('success', 'Data saved successfully!');
        Artisan::call("optimize");
        // return view('admin.pages.index');
        return redirect()->back();
    }
  
    public function show(Page $page)
    {
        return $page->title;
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', ['page' => $page]);
    }

    public function update(Page $page, Request $request) 
    {
        $request->validate([
            'title' => 'required|string|unique:pages,title,'. $page->id,
            'layout' => 'required',

        ]);
        
        $input = $request->all();   
        $title = $input['title'];
        $slug = Str::slug($title, '-'); 
        $input['slug'] = $slug;
        $page->update($input);
        $request->session()->flash('success', 'Data updated successfully!');
        Artisan::call("optimize");
        // return view('admin.pages.index');
        return redirect()->back();

        // return redirect()->route('pages.index');
    }
  
    public function destroy(Request $request, Page $page)
    {
        $page->delete();
        $request->session()->flash('success', 'Data deleted successfully!');
        return redirect()->route('pages.index');
    }

    public function search(Request $request){
        $data = $request->input('search');
        $pages = Page::where('title', 'like', "%$data%")->paginate(12);
 
        return view('admin.pages.index', ['pages'=>$pages]);
    }
}