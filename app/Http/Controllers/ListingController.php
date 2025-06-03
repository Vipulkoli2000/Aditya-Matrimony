<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Listing::with('category');
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('business_name', 'like', '%' . $search . '%')
                  ->orWhere('contact_person', 'like', '%' . $search . '%')
                  ->orWhere('city', 'like', '%' . $search . '%');
        }
        
        $listings = $query->orderBy('id', 'desc')->paginate(10);
        
        return view('admin.listing.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ListingCategory::all();
        $countries = config('data.country');
        $states = config('data.state');
        
        return view('admin.listing.create', compact('categories', 'countries', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'listing_category_id' => 'required|exists:listing_categories,id',
            'business_name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $data = $request->except('photo');
        
        // Handle file upload if provided
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/listings', $filename);
            $data['photo'] = $filename;
        }
        
        Listing::create($data);
        
        return redirect()->route('listing.index')
            ->with('success', 'Listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $listing = Listing::with('category')->findOrFail($id);
        return view('admin.listing.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listing = Listing::findOrFail($id);
        $categories = ListingCategory::all();
        $countries = config('data.country');
        $states = config('data.state');
        
        return view('admin.listing.edit', compact('listing', 'categories', 'countries', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $listing = Listing::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'listing_category_id' => 'required|exists:listing_categories,id',
            'business_name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $data = $request->except(['photo', '_token', '_method', 'remove_photo']);
        
        // Handle photo removal if requested
        if ($request->filled('remove_photo') && $request->remove_photo == '1') {
            // Delete old photo if exists
            if ($listing->photo) {
                Storage::delete('public/listings/' . $listing->photo);
            }
            $data['photo'] = null;
        }
        // Handle file upload if provided (only if not removing)
        elseif ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($listing->photo) {
                Storage::delete('public/listings/' . $listing->photo);
            }
            
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/listings', $filename);
            $data['photo'] = $filename;
        }
        
        $listing->update($data);
        
        return redirect()->route('listing.index')
            ->with('success', 'Listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $listing = Listing::findOrFail($id);
        
        // Delete photo if exists
        if ($listing->photo) {
            Storage::delete('public/listings/' . $listing->photo);
        }
        
        $listing->delete();
        
        return redirect()->route('listing.index')
            ->with('success', 'Listing deleted successfully');
    }
}
