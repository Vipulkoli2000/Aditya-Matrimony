<?php
namespace App\Http\Controllers\admin;
use Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caste;
use App\Models\SubCaste;
use App\Http\Requests\CasteRequest;
use Illuminate\Support\Facades\DB;

class CastesController extends Controller
{
    public function index(Request $request)
    {
        $query = Caste::withCount('subCastes');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }
        
        $castes = $query->orderBy('id', 'desc')->paginate(12);
        
        // Append search parameter to pagination links
        if ($request->has('search')) {
            $castes->appends(['search' => $request->search]);
        }
        
        return view('admin.castes.index', ['castes' => $castes]);
    }

    public function create()
    {
        return view('admin.castes.create');
    }

    public function store(CasteRequest $request) 
    {
        // Validate subcaste names for duplicates
        if ($request->has('subcastes') && is_array($request->subcastes)) {
            $subcasteNames = array_filter(array_map('trim', $request->subcastes));
            if (count($subcasteNames) !== count(array_unique($subcasteNames))) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['subcastes' => 'Duplicate subcaste names are not allowed.']);
            }
        }
        
        DB::beginTransaction();
        try {
            // Create the caste
            $caste = Caste::create(['name' => $request->name]);
            
            // Create subcastes if provided
            if ($request->has('subcastes') && is_array($request->subcastes)) {
                foreach ($request->subcastes as $subcasteName) {
                    if (!empty(trim($subcasteName))) {
                        SubCaste::create([
                            'name' => trim($subcasteName),
                            'caste_id' => $caste->id
                        ]);
                    }
                }
            }
            
            DB::commit();
            $request->session()->flash('success', 'Caste and sub-castes saved successfully!');
            return redirect()->route('castes.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('error', 'Failed to save caste: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
  
    public function show(Caste $caste)
    {
        return $caste->name;
    }

    public function edit(Caste $caste)
    {
        $caste->load('subCastes');
        return view('admin.castes.edit', ['caste' => $caste]);
    }

    public function update(Caste $caste, CasteRequest $request) 
    {
        // Validate subcaste names for duplicates
        if ($request->has('subcastes') && is_array($request->subcastes)) {
            $subcasteNames = array_filter(array_map('trim', $request->subcastes));
            if (count($subcasteNames) !== count(array_unique($subcasteNames))) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['subcastes' => 'Duplicate subcaste names are not allowed.']);
            }
        }
        
        DB::beginTransaction();
        try {
            // Update the caste
            $caste->update(['name' => $request->name]);
            
            // Get existing subcaste IDs
            $existingSubcasteIds = $caste->subCastes->pluck('id')->toArray();
            $updatedSubcasteIds = [];
            
            // Update or create subcastes
            if ($request->has('subcastes') && is_array($request->subcastes)) {
                foreach ($request->subcastes as $index => $subcasteName) {
                    if (!empty(trim($subcasteName))) {
                        // Check if this is an update or new subcaste
                        if (isset($request->subcaste_ids[$index]) && in_array($request->subcaste_ids[$index], $existingSubcasteIds)) {
                            // Update existing subcaste
                            $subcasteId = $request->subcaste_ids[$index];
                            SubCaste::where('id', $subcasteId)->update(['name' => trim($subcasteName)]);
                            $updatedSubcasteIds[] = $subcasteId;
                        } else {
                            // Create new subcaste
                            $newSubcaste = SubCaste::create([
                                'name' => trim($subcasteName),
                                'caste_id' => $caste->id
                            ]);
                            $updatedSubcasteIds[] = $newSubcaste->id;
                        }
                    }
                }
            }
            
            // Delete removed subcastes
            $toDelete = array_diff($existingSubcasteIds, $updatedSubcasteIds);
            if (!empty($toDelete)) {
                SubCaste::whereIn('id', $toDelete)->delete();
            }
            
            DB::commit();
            $request->session()->flash('success', 'Caste and sub-castes updated successfully!');
            return redirect()->route('castes.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('error', 'Failed to update caste: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
  
    public function destroy(Request $request, Caste $caste)
    {
        $caste->delete();
        $request->session()->flash('success', 'Caste deleted successfully!');
        return redirect()->route('castes.index');
    }

    public function search(Request $request){
        $data = $request->input('search');
        $castes = Caste::withCount('subCastes')
            ->where('name', 'like', "%$data%")
            ->paginate(12);
 
        return view('admin.castes.index', ['castes' => $castes]);
    }

    public function getSubcastes($casteId)
    {
        $subcastes = SubCaste::where('caste_id', $casteId)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);
        
        return response()->json($subcastes);
    }
}
