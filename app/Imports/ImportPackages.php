<?php
namespace App\Imports;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Package;
use App\Models\Profile;
use App\Models\Employee;
use App\Models\Stockist;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportPackages implements ToModel,WithHeadingRow,WithValidation, WithBatchInserts, WithChunkReading
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
           'name'=> 'required|string',
           'description'=> 'nullable',
           'tokens'=>'required',
           'validity' => 'required',
           'price' => 'required',
        ];
    }
    
    public function customValidationMessages()
    {
        return [
            // 'stockist.unique' => 'Stockists Already Exist',
        ];
    }
    
    public function model(array $row)
    {
       
        $user = Package::create([
            'name' => $row['name'],
            'description' => $row['description'],
            'tokens' => $row['tokens'],
            'price' => $row['price'],
            'validity' => $row['validity'],
        ]);
              
        return null; 
        
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}