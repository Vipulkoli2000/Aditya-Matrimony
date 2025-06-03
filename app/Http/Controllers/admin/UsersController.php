<?php
namespace App\Http\Controllers\admin;
use Excel;
use App\Models\User;
use App\Models\Profile;
use App\Http\Controllers\DB;
use App\Imports\ImportUsers;
use Illuminate\Http\Request;
use App\Models\ProfilePackage;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    // public function index()
    // {
    //     $users = User::orderBy('id', 'desc')->paginate(12);
    //     return view('admin.users.index', ['users' => $users]);
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // Get status filter input
    
        $users = User::with('profile') // Eager load the profile
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('mobile', 'like', "%{$search}%")
                      ->orWhereHas('roles', function ($query) use ($search) {
                          $query->where('name', 'like', "%{$search}%");
                      });
            })
            ->when(isset($status), function ($query) use ($status) {
                $query->where('active', $status);
            })
            ->orderByDesc('active') 
            ->orderByDesc('id')
            ->paginate(12);
    
        return view('admin.users.index', ['users' => $users, 'search' => $search, 'status' => $status]);
    }
    


    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create')->with(['roles' => $roles]);
    }

    public function store(User $user, Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'nullable',
            'password' => 'required',
            'active' => 'required|boolean',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'active' =>true,
            'active' => $request->active,

        ]);  
        $user->syncRoles($request->get('role'));
        $request->session()->flash('success', 'User saved successfully!');

        return redirect()->route('users.index');

    }
  
    public function edit(User $user)
    {
        return view('admin.users.edit')->with([
            'user'  => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    public function update(User $user, UserRequest $request) 
    {
        
        $user->update($request->all());
        
        // $profile = Profile::find($user->id);
        $profile = $user->profile ?? new Profile();
        $profile->email = $request->input("email");
        $profile->mobile = $request->input("mobile");
        $profile->first_name = $request->input('name');
        $profile->save();
        $user->syncRoles($request->get('role'));
        $request->session()->flash('success', 'User updated successfully!');
        return redirect()->route('users.index');
    }
  
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $request->session()->flash('success', 'User deleted successfully!');
        return redirect()->route('users.index');
    }

    public function import()
    {
        return view('users.import');
    }

    public function importUsersExcel(Request $request)
    {      
        try {
            Excel::import(new ImportUsers, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('users.index');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

  public function refresh_status(){
     
    $profiles = Profile::all();
    
   foreach($profiles as $profile){

    $totalTokens = ProfilePackage::where('profile_id', $profile->id)
    ->where('expires_at', '>', now())
    ->get()
    ->sum(function($package){
        return $package->tokens_received - $package->tokens_used;
    });
    $r = 198;
    // if($profile->id === $r){
        
    //     dd($profile->available_tokens, $totalTokens);
    // }
    
    
     $profile->update(['available_tokens'=> $totalTokens]);
      $user = User::find($profile->user_id);
    //   $r = 198;
    //   if($profile->id ===$r ){
    //     dd($user);

    //   }
     if($profile->available_tokens === 0){
        $val = 0;
        if($user){
            $user->active = $val;
            $user->save();
            
        }
      
      
        }else{
            $val = 1;
            if($user){
                $user->active = $val;
                $user->save();
                       
            }
            
        }
   }

   return redirect()->back()->with("success","Users Status Refreshed Successfully");
  }

    
}