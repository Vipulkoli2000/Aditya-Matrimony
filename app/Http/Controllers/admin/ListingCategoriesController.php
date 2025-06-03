<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ListingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListingCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ListingCategory::latest()->get();
        return view('admin.listing_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.listing_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'listing_category' => 'required|string|max:255|unique:listing_categories'
        ]);
        
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 0,
                    'error' => $validator->errors()
                ]);
            }
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        ListingCategory::create([
            'listing_category' => $request->listing_category
        ]);
        
        if ($request->ajax()) {
            return response()->json([
                'status' => 1,
                'message' => 'Listing category created successfully'
            ]);
        }
        
        return redirect()->route('listing-categories.index')
            ->with('success', 'Listing category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = ListingCategory::findOrFail($id);
        return view('admin.listing_categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = ListingCategory::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'listing_category' => 'required|string|max:255|unique:listing_categories,listing_category,' . $id
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 0,
                    'error' => $validator->errors()
                ]);
            }
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->update([
            'listing_category' => $request->listing_category
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 1,
                'message' => 'Listing category updated successfully'
            ]);
        }
        
        return redirect()->route('listing-categories.index')
            ->with('success', 'Listing category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ListingCategory::findOrFail($id);
        $category->delete();
        
        return redirect()->route('listing-categories.index')
            ->with('success', 'Listing category deleted successfully');
    }
}
