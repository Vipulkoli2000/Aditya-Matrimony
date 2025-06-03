<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\ProfilePackage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationsExport;
use App\Exports\PaymentsExport;
use App\Exports\ExpiringPackagesExport;
use App\Exports\BrideGroomsExport;

class ReportController extends Controller
{
    /**
     * Display the user registrations report page
     */
    public function registrations(Request $request)
    {
        $query = User::with(['profile', 'profile.profilePackages'])
            ->role('member');  // Using Spatie's role() scope instead of where('role', 'member')
            
        // Apply date filters if provided
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $registrations = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->except('page'));

        return view('admin.reports.registrations', compact('registrations'));
    }

    /**
     * Display the payments report page
     */
    public function payments(Request $request)
    {
        $query = ProfilePackage::with(['profile.user', 'package'])->where('status', true);
        
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $payments = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->except('page'));

        return view('admin.reports.payments', compact('payments'));
    }

    /**
     * Display the expiring packages report page
     */
    public function expiringPackages(Request $request)
    {
        $expiringDate = Carbon::now()->addDays(30);
        $query = ProfilePackage::with(['profile', 'package'])
            ->whereDate('expires_at', '>=', Carbon::now())
            ->whereDate('expires_at', '<=', $expiringDate);
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('expires_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('expires_at', '<=', $request->to_date);
        }
        $expiringPackages = $query->orderBy('expires_at', 'asc')
            ->paginate(15)
            ->appends($request->except('page'));

        return view('admin.reports.expiring_packages', compact('expiringPackages'));
    }

    /**
     * Display Bride/Grooms report page
     */
    public function brideGrooms(Request $request)
    {
        $query = User::with('profile')->role('member');
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }
        $brideGrooms = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->except('page'));
        return view('admin.reports.bride_grooms', compact('brideGrooms'));
    }

    /**
     * Export registrations report as PDF
     */
    public function exportRegistrationsPdf(Request $request)
    {
        $query = User::with(['profile', 'profile.profilePackages'])
            ->role('member');  // Using Spatie's role() scope instead of where('role', 'member')
            
        // Apply date filters if provided
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $registrations = $query->orderBy('created_at', 'desc')
            ->get();

        // Pass date range to PDF view
        $from_date = $request->from_date ?? null;
        $to_date = $request->to_date ?? null;

        $pdf = PDF::loadView('admin.reports.exports.registrations_pdf', compact('registrations', 'from_date', 'to_date'));
        return $pdf->download('user_registrations_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export registrations report as Excel
     */
    public function exportRegistrationsExcel(Request $request)
    {
        return Excel::download(new RegistrationsExport($request), 'user_registrations_' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Export payments report as PDF
     */
    public function exportPaymentsPdf(Request $request)
    {
        $query = ProfilePackage::with(['profile.user', 'package'])->where('status', true);
        
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $payments = $query->orderBy('created_at', 'desc')->get();
        
        // Pass date range to PDF view
        $from_date = $request->from_date ?? null;
        $to_date = $request->to_date ?? null;

        $pdf = PDF::loadView('admin.reports.exports.payments_pdf', compact('payments', 'from_date', 'to_date'));
        return $pdf->download('payment_report_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export payments report as Excel
     */
    public function exportPaymentsExcel(Request $request)
    {
        return Excel::download(new PaymentsExport($request), 'payment_report_' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Export expiring packages report as PDF
     */
    public function exportExpiringPackagesPdf(Request $request)
    {
        $expiringDate = Carbon::now()->addDays(30);
        $query = ProfilePackage::with(['profile', 'package'])
            ->whereDate('expires_at', '>=', Carbon::now())
            ->whereDate('expires_at', '<=', $expiringDate);
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('expires_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('expires_at', '<=', $request->to_date);
        }
        $expiringPackages = $query->orderBy('expires_at', 'asc')->get();

        // Pass date range to PDF view
        $from_date = $request->from_date ?? null;
        $to_date = $request->to_date ?? null;

        $pdf = PDF::loadView('admin.reports.exports.expiring_packages_pdf', compact('expiringPackages', 'from_date', 'to_date'));
        return $pdf->download('expiring_packages_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export expiring packages report as Excel
     */
    public function exportExpiringPackagesExcel(Request $request)
    {
        return Excel::download(new ExpiringPackagesExport($request), 'expiring_packages_' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Export Bride/Grooms report as PDF
     */
    public function exportBrideGroomsPdf(Request $request)
    {
        $query = User::with('profile')->role('member');
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }
        $brideGrooms = $query->orderBy('created_at', 'desc')->get();
        $pdf = PDF::loadView('admin.reports.exports.bride_grooms_pdf', compact('brideGrooms'));
        return $pdf->download('bride_grooms_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export Bride/Grooms report as Excel
     */
    public function exportBrideGroomsExcel(Request $request)
    {
        return Excel::download(new BrideGroomsExport($request), 'bride_grooms_' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }
}
