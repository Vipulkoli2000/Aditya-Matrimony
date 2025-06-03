<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Profile;
use App\Models\SubCaste;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function view($pageId)
    {
       $page = Page::find($pageId);
       if (!$page) {
        abort(404, 'Page not found');
    }
         
    return view('default.view.pages.' . $page->layout, compact('page'));

}
}