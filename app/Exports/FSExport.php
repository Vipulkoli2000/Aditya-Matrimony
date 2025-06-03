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
use App\Models\FreeSchemeDetail;
use Illuminate\Contracts\View\View;
use App\Models\DoctorBusinessMonitoring;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FSExport implements FromView
{
    use Exportable;
    public function __construct($from_date,$to_date,$doctor,$zonalManager)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->doctor = $doctor;
        $this->zonalManager = $zonalManager;
    }

    public function view(): View
    {
        $condition = [];
        if(isset($this->from_date)){
            $fromDate = Carbon::createFromFormat('Y-m-d', $this->from_date);
            $condition[] = ['proposal_date', '>=' , $fromDate];
        }        
        
        if(isset($this->to_date)){
            $toDate = Carbon::createFromFormat('Y-m-d', $this->to_date);
            $condition[] = ['proposal_date', '<=' , $toDate];
        }

        if(isset($this->doctor)){
            $condition[] = ['doctor_id', '=' , $this->doctor];
        }
        
        $condition[] = ['approval_level_2', '=', true];

        $query = FreeSchemeDetail::with([
            'Product', 
            'FreeScheme' => [
                'Manager' => ['AreaManager', 'ZonalManager'], 
                'Stockist', 
                'Chemist', 
                'Doctor'
            ]
        ]);
    

    //    start
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $query->whereHas('FreeScheme', function($query){
                $query->where('employee_id', '=', auth()->user()->id);
            });
        
        } elseif($authUser == 'Area Manager'){
            $query->whereHas('FreeScheme', function($query){
                $query->whereHas('Manager', function($query){
                $query->where('reporting_office_2', '=', auth()->user()->id);
            });
        });
        
        } elseif($authUser == 'Zonal Manager'){
            $query->whereHas('FreeScheme', function($query){
                $query->whereHas('Manager', function($query){
                $query->where('reporting_office_1', '=', auth()->user()->id);
            });
        });
          
        }  

    // end
    
        if (isset($this->zonalManager)) {
            $query->whereHas('FreeScheme', function ($query) {
                $query->whereHas('Manager', function ($query) {
                    $query->whereHas('ZonalManager', function ($query) {
                        $query->where('id', '=', $this->zonalManager);
                    });
                });
            });
        }
    
        $printData = $query->whereRelation('FreeScheme', $condition)->get();
       
        return view('free_schemes.print', [
        // 'print' => FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get()
          'print' => $printData,   
      ]);
    }
}
