<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\FranchisePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FranchiseController extends Controller
{
    /**
     * Display a listing of the franchise.
     */
    public function index(Request $request)
    {
        $query = Franchise::query();
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('franchise_code', 'like', "%{$search}%");
            });
        }
        
        // Status filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('active', $status);
        }
        
        $franchises = $query->with('payments')->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.franchises.index', compact('franchises'));
    }

    /**
     * Show the form for creating a new franchise.
     */
    public function create()
    {
        return view('admin.franchises.create');
    }

    /**
     * Store a newly created franchise in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile' => 'required|string|max:15|unique:franchises,mobile',
            'location' => 'required|string|max:255',
            'franchise_code' => 'nullable|string|max:255|unique:franchises,franchise_code',
            'email' => 'required|string|email|max:255|unique:franchises,email',
            'password' => 'required|string|min:8|confirmed',
            'active' => 'nullable|boolean',
        ]);

        // Generate franchise code if not provided
        if (empty($validated['franchise_code'])) {
            $validated['franchise_code'] = Franchise::generateFranchiseCode();
        }

        $validated['active'] = $request->has('active');

        $franchise = Franchise::create($validated);

        return redirect()->route('admin.franchises.index')
            ->with('success', 'Franchise created successfully!');
    }

    /**
     * Display the specified franchise.
     */
    public function show(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        return view('admin.franchises.show', compact('franchise'));
    }

    /**
     * Show the form for editing the specified franchise.
     */
    public function edit(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        return view('admin.franchises.edit', compact('franchise'));
    }

    /**
     * Update the specified franchise in storage.
     */
    public function update(Request $request, string $id)
    {
        $franchise = Franchise::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile' => ['required', 'string', 'max:15', Rule::unique('franchises')->ignore($franchise->id)],
            'location' => 'required|string|max:255',
            'franchise_code' => ['required', 'string', 'max:255', Rule::unique('franchises')->ignore($franchise->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('franchises')->ignore($franchise->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->has('active');

        // Only update password if provided
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $franchise->update($validated);

        return redirect()->route('admin.franchises.index')
            ->with('success', 'Franchise updated successfully!');
    }

    /**
     * Remove the specified franchise from storage.
     */
    public function destroy(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        $franchise->delete();

        return redirect()->route('admin.franchises.index')
            ->with('success', 'Franchise deleted successfully!');
    }

    /**
     * Toggle the status of the specified franchise.
     */
    public function toggleStatus(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        $franchise->update(['active' => !$franchise->active]);

        $status = $franchise->active ? 'activated' : 'deactivated';
        
        return redirect()->back()
            ->with('success', "Franchise {$status} successfully!");
    }

    /**
     * Show payment tracking page for a franchise
     */
    public function payments(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        $currentYear = request('year', date('Y'));
        
        // Dynamic year range based on selected year
        $baseRange = 7;
        $minYear = min($currentYear - $baseRange, date('Y') - $baseRange);
        $maxYear = max($currentYear + $baseRange, date('Y') + $baseRange);
        $years = range($minYear, $maxYear);
        
        $payment = FranchisePayment::firstOrCreate(
            [
                'franchise_id' => $franchise->id,
                'year' => $currentYear
            ],
            [
                'january' => false,
                'february' => false,
                'march' => false,
                'april' => false,
                'may' => false,
                'june' => false,
                'july' => false,
                'august' => false,
                'september' => false,
                'october' => false,
                'november' => false,
                'december' => false,
            ]
        );
        
        return view('admin.franchises.payments', compact('franchise', 'payment', 'years', 'currentYear'));
    }

    /**
     * Update payment tracking for a franchise
     */
    public function updatePayments(Request $request, string $id)
    {
        $franchise = Franchise::findOrFail($id);
        $year = $request->input('year', date('Y'));
        
        $payment = FranchisePayment::firstOrCreate(
            [
                'franchise_id' => $franchise->id,
                'year' => $year
            ]
        );
        
        // Update all month checkboxes
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 
                   'july', 'august', 'september', 'october', 'november', 'december'];
        
        foreach ($months as $month) {
            $payment->$month = $request->has($month);
        }
        
        $payment->save();
        
        return redirect()->back()->with('success', 'Payment records updated successfully!');
    }

    /**
     * Show payment tracking page for franchise user (their own payments)
     */
    public function franchisePayments()
    {
        $franchise = Auth::guard('franchise')->user();
        $currentYear = request('year', date('Y'));
        
        // Dynamic year range based on selected year
        $baseRange = 7;
        $minYear = min($currentYear - $baseRange, date('Y') - $baseRange);
        $maxYear = max($currentYear + $baseRange, date('Y') + $baseRange);
        $years = range($minYear, $maxYear);
        
        $payment = FranchisePayment::firstOrCreate(
            [
                'franchise_id' => $franchise->id,
                'year' => $currentYear
            ],
            [
                'january' => false,
                'february' => false,
                'march' => false,
                'april' => false,
                'may' => false,
                'june' => false,
                'july' => false,
                'august' => false,
                'september' => false,
                'october' => false,
                'november' => false,
                'december' => false,
            ]
        );
        
        return view('admin.franchises.payments-readonly', compact('franchise', 'payment', 'years', 'currentYear'));
    }
}