<?php

namespace App\Exports;


use DB;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\Employee;
use App\Models\FreeScheme;
use Illuminate\Http\Request;
use App\Models\GrantApproval;
use App\Models\ProductDetail;
use App\Models\CustomerTracking;
use Illuminate\Contracts\View\View;
use App\Models\CustomerTrackingDetail;
use App\Models\DoctorBusinessMonitoring;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CTExport implements FromView
{
    use Exportable;
    public function __construct($from_date,$to_date,$zonalManager,$doctor)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->zonalManager = $zonalManager;
        $this->doctor = $doctor;
    }

    public function view(): View
    {
        $condition = [];
        if(isset($this->from_date)){
            $fromDate = Carbon::createFromFormat('Y-m-d', $this->from_date);
            $condition[] = ['proposal_date', '>=' , $fromDate];
            // dd($fromDate);
        }        
        
        if(isset($this->to_date)){
            $toDate = Carbon::createFromFormat('Y-m-d', $this->to_date);
            $condition[] = ['proposal_date', '<=' , $toDate];
        }
        
        $query = CustomerTrackingDetail::with(['CustomerTracking' => ['Manager' => ['AreaManager', 'ZonalManager']], 'Doctor']);

        //  start
        // $customer_trackings = CustomerTracking::with(['Manager'=>['ZonalManager', 'AreaManager'], 'CustomerTrackingDetail'])->orderBy('id', 'DESC')->paginate(12);

        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $query->whereHas('CustomerTracking', function($query){
                $query->whereHas('Manager', function($query){
                       $query->where('employee_id', '=', auth()->user()->id);
                });
           });
          
        } elseif($authUser == 'Area Manager'){
            $query->whereHas('CustomerTracking', function($query){
                $query->whereHas('Manager', function($query){
                       $query->where('reporting_office_2', '=', auth()->user()->id);
                });
           });
           
        } elseif($authUser == 'Zonal Manager'){
            $query->whereHas('CustomerTracking', function($query){
                $query->whereHas('Manager', function($query){
                       $query->where('reporting_office_1', '=', auth()->user()->id);
                });
           });      
        }       

        // end

          if(isset($this->zonalManager)){
            $query->whereHas('CustomerTracking', function($query){
                 $query->whereHas('Manager', function($query){
                    $query->whereHas('ZonalManager', function($query){
                        $query->where('id', '=', $this->zonalManager);
                    });
                 });
            });
          }

          if(isset($this->doctor)){
            $query->whereHas('Doctor', function($query){
                 $query->where('id', '=', $this->doctor);
            });
          }

          $printData = $query->whereRelation('CustomerTracking', $condition)->get();
        return view('customer_trackings.print', [
            // 'print' => RoiAccountabilityReportDetail::with(['RoiAccountabilityReport'])->whereRelation('RoiAccountabilityReport', $condition)->get()
            'print' => $printData
        ]);
    }
}

