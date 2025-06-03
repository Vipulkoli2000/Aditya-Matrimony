<?php

namespace App\Exports;
use DB;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\GrantApproval;
use App\Models\DoctorBusinessMonitoring;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Http\Request;

class CDBMExport implements FromView
{
    use Exportable;
    public function __construct($from_date, $to_date, $doctor,$zonalManager)
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
            $condition[] = ['date', '>=' , $fromDate];
        }        

        if(isset($this->to_date)){
            $toDate = Carbon::createFromFormat('Y-m-d', $this->to_date);
            $condition[] = ['date', '<=' , $toDate];
        }

        // start
        $authUser = auth()->user()->roles->pluck('name')->first();

        // $query = DoctorBusinessMonitoring::with(['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']]);
        $query = ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager' => ['ZonalManager','AreaManager'], 'Doctor']]]);

        if($authUser == 'Marketing Executive'){ 
            $query->whereHas('DoctorBusinessMonitoring', function($query){         
            $query->whereHas('GrantApproval', function($query){
                $query->where('employee_id', '=', auth()->user()->id);
           });
        });
        } elseif($authUser == 'Area Manager'){
            $query->whereHas('DoctorBusinessMonitoring', function($query){         
            $query->whereHas('GrantApproval', function($query){
                  $query->whereHas('Manager', function($query){
                    $query->whereHas('AreaManager', function($query){
                         $query->where('id', '=', auth()->user()->id);
                    });
                 });
             });
            });
        } elseif($authUser == 'Zonal Manager'){
            $query->whereHas('DoctorBusinessMonitoring', function($query){         
             $query->whereHas('GrantApproval', function($query){
                  $query->whereHas('Manager', function($query){
                    $query->whereHas('ZonalManager', function($query){
                         $query->where('id', '=', auth()->user()->id);
                    });
                 });
             });
            });
        }      

        // end

        // $query = ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager' => ['ZonalManager','AreaManager'], 'Doctor']]]);
        
        if(isset($this->zonalManager)){
             $query->whereHas('DoctorBusinessMonitoring', function($query){
                $query->whereHas('GrantApproval', function($query){
                    $query->whereHas('Manager', function($query){
                       $query->wherehas('ZonalManager', function($query){
                        $query->where('id', '=', $this->zonalManager);
                       });
                    });
                });
             });
        }

        if(isset($this->doctor)){
            $query->whereHas('DoctorBusinessMonitoring', function($query){
               $query->whereHas('GrantApproval', function($query){
                   $query->whereHas('Doctor', function($query){
                       $query->where('doctor_id', '=', $this->doctor);
                      
                   });
               });
            });
       }


        

        $printData = $query->whereRelation('DoctorBusinessMonitoring', $condition)->get();

        return view('doctor_business_monitorings.print', [
            // 'print' => ProductDetail::with(['Product', 'DoctorBusinessMonitoring'=>['GrantApproval'=>['Manager'=>['ZonalManager', 'AreaManager'],'Doctor']]])->whereRelation('DoctorBusinessMonitoring', $condition)->get()
           'print'=>$printData
        ]);
    } 
}
