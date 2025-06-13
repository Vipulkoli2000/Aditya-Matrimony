<x-layout.admin>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('user_profiles.index') }}" class="text-primary hover:underline">Profile Details</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>edit</span>
            </li>
        </ul>

        <div class="pt-5">        
            <form class="space-y-5" enctype="multipart/form-data" action="{{ route('user_profiles.update', ['id'=>$profile->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Personal Information</h5>
                    </div>               
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     
                        <x-text-input name="first_name" class="bg-gray-200" value="{{ $profile->first_name }}" :label="__('First Name')" :require="true" :disabled="true" :messages="$errors->get('first_name')"/>   
                        <x-text-input name="middle_name" class="bg-gray-200" value="{{ $profile->middle_name }}" :label="__('Middle Name')" :require="true" :disabled="true" :messages="$errors->get('middle_name')"/>                       
                        <x-text-input name="last_name" class="bg-gray-200" value="{{ $profile->last_name }}" :label="__('Last Name')" :require="true" :disabled="true" :messages="$errors->get('last_name')"/>                                           
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     
                            <div>
                                <label>Mother Tongue</label>
                                <select class="form-input" name="mother_tongue"   id="mother_tongue">
                                    <option value="" selected>select an option</option>
                                    @foreach(config('data.mother_tongues') as $value => $name)
                                    <option value="{{ $value }}" {{($profile->mother_tongue === $value) ? 'selected': ''}} >{{ $name }}</option>
                                @endforeach
                                </select> 
                                <x-input-error :messages="$errors->get('mother_tongue')" class="mt-2" /> 
                            </div> 
                        <x-text-input name="native_place" value="{{ $profile->native_place }}" :label="__('Native Place')" :require="false" :messages="$errors->get('native_place')"/>                       
                        <x-text-input name="gender" class="bg-gray-200" value="{{$profile->gender}}" :label="__('Gender')" :require="true" :messages="$errors->get('gender')" :disabled="true"/>                                           
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     
                        <div>
                            <label>Marital Status <span class="text-red-500">*</span></label>
                            <select class="form-input" name="marital_status" id="marital_status">
                               <option value="" >select an option</option>
                                @foreach (config('data.marital_status') as $value => $name)
                                    <option value="{{$value}}" {{ ($profile->marital_status === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                @endforeach
                            </select> 
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" /> 
                        </div>                         
                            <div>
                                <label>Living With <span class="text-red-500">*</span></label>
                                <select class="form-input" name="living_with" id="living_with">
                                    <option value="" selected>select an option</option>
                                    @foreach (config('data.living_with') as $value => $name)
                                        <option value="{{$value}}" {{ ($profile->living_with === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                    @endforeach
                                </select> 
                                <x-input-error :messages="$errors->get('living_with')" class="mt-2" /> 
                            </div>  
                            <div>
                                <label>Role <span class="text-red-500">*</span></label>
                                <select class="form-input" name="role" id="role">
                                     @foreach (config('data.role', []) as $value => $name)
                                    <option value="{{ $value }}" {{ ($profile->role === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select> 
                                <x-input-error :messages="$errors->get('role')" class="mt-2" /> 
                            </div>  
                       </div>
                </div>               
        </div>


        <div class="pt-5">        
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Health Information</h5>
                    </div>               
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                        <div>
                            <label>Blood Group <span class="text-red-500">*</span></label>
                            <select class="form-input" name="blood_group" id="blood_group">
                                <option value="" selected>select an option</option>
                                @foreach (config('data.blood_group') as $value => $name)
                                    <option value="{{$value}}" {{ ($profile->blood_group === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                @endforeach
                            </select> 
                            <x-input-error :messages="$errors->get('blood_group')" class="mt-2" /> 
                        </div> 
                        <div>
                            <label>Height <span class="text-red-500">*</span></label>
                            <select class="form-input" name="height" id="height">
                                <option value="" selected>select an option</option>
                                @foreach (config('data.height') as $value => $name)
                                    <option value="{{$value}}" {{ ($profile->height === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                @endforeach
                            </select> 
                            <x-input-error :messages="$errors->get('height')" class="mt-2" /> 
                        </div>    
                        <x-text-input name="weight" value="{{ $profile->weight}}" :label="__('Weight in kg')" :require="false"  :messages="$errors->get('weight')"/>   
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     
                            <div>
                                <label>Body Type <span class="text-red-500">*</span></label>
                                <select class="form-input" name="body_type" id="body_type">
                                    <option value="" selected>select an option</option>
                                    @foreach (config('data.body_type') as $value => $name)
                                        <option value="{{$value}}" {{ ($profile->body_type === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                    @endforeach
                                </select> 
                                <x-input-error :messages="$errors->get('body_type')" class="mt-2" /> 
                            </div> 
                            <div>
                                <label>Complexion <span class="text-red-500">*</span></label>
                                <select class="form-input" name="complexion" id="complexion">
                                    <option value="" selected>select an option</option>
                                    @foreach (config('data.complexion') as $value => $name)
                                        <option value="{{$value}}" {{ ($profile->complexion === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                    @endforeach
                                </select> 
                                <x-input-error :messages="$errors->get('complexion')" class="mt-2" /> 
                            </div> 
                            <div>
                                <label>Physical Abnormality <span class="text-red-500">*</span></label>
                                <select class="form-input" name="physical_abnormality" id="physical_abnormality">
                                   <option value="" selected>select an option</option>
                                    <option value="1" {{$profile->physical_abnormality === 1 ? 'selected' : ''}} >Yes</option>
                                    <option value="0" {{$profile->physical_abnormality === 0 ? 'selected' : ''}}>No</option>
                                </select> 
                                <x-input-error :messages="$errors->get('physical_abnormality')" class="mt-2" /> 
                            </div> 
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     
                      <div class="flex items-center">
                        <input type="checkbox" {{($profile->spectacles === 1 ? 'checked' : '')}} name="spectacles" id="spectacles" class="form-checkbox text-primary rounded border-gray-300 focus:ring-primary">
                        <label for="checkbox" class="ml-2">Spectacles</label>
                      </div>  
                      <div class="flex items-center">
                        <input type="checkbox" {{($profile->lens === 1 ? 'checked' : '')}} name="lens" id="lens" class="form-checkbox text-primary rounded border-gray-300 focus:ring-primary">
                        <label for="checkbox" class="ml-2">Lens</label>
                      </div>                     
                 </div>
                </div>            
        </div>

        <div class="pt-5">        
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Food Habits</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                    <div>
                        <label>Eating Habits</label>
                        <select class="form-input" name="eating_habits" id="eating_habits">
                            <option value="" selected>select an option</option>
                                    @foreach (config('data.eating_habits') as $value => $name)
                                        <option value="{{$value}}" {{ ($profile->eating_habits === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                    @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('eating_habits')" class="mt-2" /> 
                    </div> 
                    <div>
                        <label>Drinking Habits</label>
                        <select class="form-input" name="drinking_habits" id="drinking_habits">
                            <option value="" selected>select an option</option>
                                    @foreach (config('data.drinking_habits') as $value => $name)
                                        <option value="{{$value}}" {{ ($profile->drinking_habits === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                    @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('drinking_habits')" class="mt-2" /> 
                    </div>    
                    <div>
                        <label>Smoking Habits</label>
                        <select class="form-input" name="smoking_habits" id="smoking_habits">
                            <option value="" selected>select an option</option>
                            @foreach (config('data.smoking_habits') as $value => $name)
                                <option value="{{$value}}" {{ ($profile->smoking_habits === $value) ? 'selected' : ''}} >{{ $name }}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('smoking_habits')" class="mt-2" /> 
                    </div> 
                </div>    
             </div>
            </div>     
            
            <div class="pt-5">        
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">About Self</h5>
                    </div>               
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                        <div>
                            <label for="about_self">About Myself:</label>
                            <textarea 
                            name="about_self"
                                id="description" 
                                class="mt-1 block w-full h-32 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                            >{{$profile->about_self}}</textarea>
                            <x-input-error :messages="$errors->get('about_self')" class="mt-2" /> 
                        </div> 
                    </div>    
                 </div>
                </div>  

                <div class="pt-5">        
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Upload Photo</h5>
                        </div>               
                        <!-- File Upload Inputs in One Row -->
                        <div class="grid grid-cols-3 gap-4 mb-5">
                            <div class="form-group">
                                <label for="photo1">Photo 1</label>
                                <input type="file" name="img_1" id="photo1" value="" class="form-input">
                                @if ($errors->has('img_1'))
                                <span class="text-danger small">{{ $errors->first('img_1') }}</span>
                                @endif  
                            </div>
                
                            <div class="form-group">
                                <label for="photo2">Photo 2</label>
                                <input type="file" name="img_2" id="photo2" class="form-input">
                                @if ($errors->has('img_2'))
                                <span class="text-danger small">{{ $errors->first('img_2') }}</span>
                                @endif  
                            </div>
                            
                            <div class="form-group">
                                <label for="photo3">Photo 3</label>
                                <input type="file" name="img_3" id="photo3" class="form-input">
                                @if ($errors->has('img_3'))
                                <span class="text-danger small">{{ $errors->first('img_3') }}</span>
                                @endif  
                            </div>
                        </div>
                        
                        <!-- Photo Previews in One Row -->
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center">
                                @if($profile->img_1)
                                <div x-data="imageLoader()" x-init="fetchImage('{{ $profile->img_1 }}')">
                                    <template x-if="imageUrl">
                                        <a :href="imageUrl" target="_blank">
                                            <img class="mx-auto max-h-24 object-cover rounded" :src="imageUrl" alt="Photo 1" />
                                        </a>
                                    </template>
                                </div>
                                @endif
                            </div>
                            
                            <div class="text-center">
                                @if($profile->img_2)
                                <div x-data="imageLoader()" x-init="fetchImage('{{ $profile->img_2 }}')">
                                    <template x-if="imageUrl">
                                        <a :href="imageUrl" target="_blank">
                                            <img class="mx-auto max-h-24 object-cover rounded" :src="imageUrl" alt="Photo 2" />
                                        </a>
                                    </template>
                                </div>
                                @endif
                            </div>
                            
                            <div class="text-center">
                                @if($profile->img_3)
                                <div x-data="imageLoader()" x-init="fetchImage('{{ $profile->img_3 }}')">
                                    <template x-if="imageUrl">
                                        <a :href="imageUrl" target="_blank">
                                            <img class="mx-auto max-h-24 object-cover rounded" :src="imageUrl" alt="Photo 3" />
                                        </a>
                                    </template>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                     
                    <div class="pt-5" x-data="{ religion: '', castes: '', subcastes: '', gotra: '' }">        
                        <div class="panel">
                            <div class="flex items-center justify-between mb-5">
                                <h5 class="font-semibold text-lg dark:text-white-light">Religious Information</h5>
                            </div>               
                            <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-3">  
                                <div>
                                    <label>Religion</label>
                                    <select class="form-input" name="religion" id="religion" disabled>
                                        <option value="hindu" selected>Hindu</option>
                                    </select> 
                                    <x-input-error :messages="$errors->get('religion')" class="mt-2" /> 
                                </div>
                                
                                
                                {{-- <template x-if="religion === 'hindu'"> --}}
                                     
                                    <div>
                                        <label>Religion</label>
                                        <select class="form-input" name="castes" id="castes" disabled>
                                            <option value="Maratha" selected>Maratha</option>
                                        </select> 
                                        <x-input-error :messages="$errors->get('castes')" class="mt-2" /> 
                                    </div>
                                {{-- </template> --}}
                    
                                {{-- <template x-if="religion === 'hindu'"> --}}
                                    <div>
                                        <label>Subcastes</label>
                                        <select name="sub_caste" class="form-input" name="subcastes" id="subcastes">
                                            <option value="" selected>select an option</option>
                                            @foreach($subCastes as $subCaste)
                                            <option value="{{$subCaste->id}}" {{ ($profile->sub_caste === $subCaste->id ) ? 'selected' : ''}}>{{$subCaste->name}}</option>
                                            @endforeach
                                        </select> 
                                        <x-input-error :messages="$errors->get('subcastes')" class="mt-2" /> 
                                    </div>
                                    
                                {{-- </template> --}}
                    
                                {{-- <template x-if="religion === 'hindu'"> --}}
                                    <x-text-input name="gotra" value="{{ $profile->gotra }}" :label="__('Gotra')" :require="false" :messages="$errors->get('gotra')"/>                       
                                {{-- </template> --}}
                            </div>    
                        </div>
                    </div> 
                    {{-- Family Profile --}}

                    
                    <div class="pt-5" x-data="{ father_is_alive: '', fullName: '', occupation: '', jobType: '', organizationName:'' }">     
                        
                        <div class="panel">
                           <h8>Family Details</h8>
                            <div class="flex items-center justify-between mb-5">
                                <h5 class="font-semibold text-lg dark:text-white-light">Father Details</h5>
                            </div>               
                            <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-3">  
                                <div>
                                    <label>Is Alive</label>
                                    <select class="form-input" name="father_is_alive"  id="father_is_alive">
                                        <option value="" selected>select an option</option>
                                        <option value="1" {{$profile->father_is_alive === 1 ? 'selected' : ''}} >Yes</option>
                                        <option value="0" {{$profile->father_is_alive === 0 ? 'selected' : ''}}>No</option>
                                    </select> 
                                    <x-input-error :messages="$errors->get('isAlive')" class="mt-2" /> 
                                </div> 
                                {{-- <template x-if="father_is_alive === 'yes'"> --}}
                                    <x-text-input name="father_name" value="{{ $profile->father_name }}" :label="__('Full Name')" :require="false" :messages="$errors->get('father_name')"/>                       
                                {{-- </template> --}}
                                
                                
                                
                                {{-- <template x-if="father_is_alive === 'yes'"> --}}
                                    <div>
                                        <label>Occupation</label>
                                        <select class="form-input" name="father_occupation" id="occupation">
                                            <option value="" selected>select an option</option>
                                    @foreach (config('data.occupation') as $value => $name)
                                        <option value="{{$value}}" {{ ($profile->father_occupation === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                    @endforeach
                                        </select> 
                                        <x-input-error :messages="$errors->get('father_occupation')" class="mt-2" /> 
                                    </div>    
                                {{-- </template> --}}
                    
                                {{-- <template x-if="father_is_alive === 'yes'"> --}}
                                    <div>
                                        <label for="father_job_type">Job Type</label>
                                        <select class="form-input" name="father_job_type" id="father_job_type">
                                            <option value="" selected>Select an option</option>
                                            @foreach (config('data.job_type') as $value => $name)
                                                <option value="{{$value}}" {{ ($profile->father_job_type === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('father_job_type'))
                                            <span class="text-danger small">{{ $errors->first('father_job_type') }}</span>
                                        @endif   
                                    </div>
                                {{-- </template> --}}
                    
                                {{-- <template x-if="father_is_alive === 'yes'"> --}}
                                    <x-text-input name="father_organization" value="{{ $profile->father_organization }}" :label="__('Organization Name')" :require="false" :messages="$errors->get('father_organization')"/>                       
                                    <x-text-input name="father_mobile" value="{{ $profile->father_mobile }}" :label="__('Mobile Number')" :require="false" :messages="$errors->get('father_mobile')" type="tel"/>
                                    <x-text-input name="father_address" value="{{ $profile->father_address }}" :label="__('Address')" :require="false" :messages="$errors->get('father_address')" type="text"/>
                                {{-- </template> --}}
                            </div>    
                            {{-- mother details --}}
                            <div class="pt-5" x-data="{ isAlive: '', fullName: '', occupation: '', jobType: '', organizationName:'' }"> 
                            <div class="flex items-center justify-between mb-5">
                                <h5 class="font-semibold text-lg dark:text-white-light">Mother Details</h5>
                            </div>               
                            <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-3">  
                                <div>
                                    <label>Is Alive</label>
                                    <select class="form-input" name="mother_is_alive" id="mother_is_alive">
                                        <option value="" selected>select an option</option>
                                        <option value="1" {{$profile->mother_is_alive === 1 ? 'selected' : ''}} >Yes</option>
                                        <option value="0" {{$profile->mother_is_alive === 0 ? 'selected' : ''}}>No</option>
                                    </select> 
                                    <x-input-error :messages="$errors->get('mother_is_alive')" class="mt-2" /> 
                                </div> 
                                {{-- <template x-if="isAlive === 'yes'"> --}}
                                    <x-text-input name="mother_name" value="{{ $profile->mother_name }}" :label="__('Full Name')" :require="false" :messages="$errors->get('mother_name')"/>                       
                                {{-- </template> --}}
                                
                                
                                {{-- <template x-if="isAlive === 'yes'"> --}}
                                    <div>
                                        <label for="mother_occupation">Occupation</label>
                                        <select class="form-input" name="mother_occupation" id="mother_occupation">
                                            <option value="" selected>Select an option</option>
                                            @foreach (config('data.occupation') as $value => $name)
                                                <option value="{{$value}}" {{ ($profile->mother_occupation === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('mother_occupation'))
                                            <span class="text-danger small">{{ $errors->first('mother_occupation') }}</span>
                                        @endif    
                                    </div>    
                                {{-- </template> --}}
                    
                                {{-- <template x-if="isAlive === 'yes'"> --}}
                                    <div>
                                        <label for="mother_job_type">Job Type</label>
                    <select class="form-input" name="mother_job_type" id="mother_job_type">
                        <option value="" selected>Select an option</option>
                        @foreach (config('data.job_type') as $value => $name)
                            <option value="{{$value}}" {{ ($profile->mother_job_type === $value) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('mother_job_type'))
                        <span class="text-danger small">{{ $errors->first('mother_job_type') }}</span>
                    @endif   
                                    </div>
                                {{-- </template> --}}
                    
                                {{-- <template x-if="isAlive === 'yes'"> --}}
                                    <x-text-input name="mother_organization" value="{{ $profile->mother_organization }}" :label="__('Organization Name')" :require="false" :messages="$errors->get('mother_organization')"/>                       
                                    <x-text-input name="mother_mobile" value="{{ $profile->mother_mobile }}" :label="__('Mobile Number')" :require="false" :messages="$errors->get('mother_mobile')" type="tel"/>
                                    <x-text-input name="mother_address" value="{{ $profile->mother_address }}" :label="__('Address')" :require="false" :messages="$errors->get('mother_address')" type="text"/>
                                {{-- </template> --}}
                                <x-text-input name="mother_native_place" value="{{ $profile->mother_native_place }}" :label="__('Mother Native Place')" :require="false" :messages="$errors->get('mother_native_place')"/>                       
                                    <x-text-input name="mother_name_before_marriage" value="{{ $profile->mother_name_before_marriage }}" :label="__('Mother Name Before Marriage')" :require="false" :messages="$errors->get('mother_name_before_marriage')"/>                       
                                {{-- </template> --}}
                            </div>  
                            </div>  
                            {{-- brother details --}}
                           <div>
                            <div class="flex items-center justify-between mb-5">
                                <h5 class="font-semibold text-lg dark:text-white-light">Brother Details</h5>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-2">  
                                {{-- <x-text-input name="residentPlace" value="{{ old('residentPlace') }}" :label="__('Resident Place')" :require="false" :messages="$errors->get('residentPlace')"/>                        --}}
                                    <div class="form-group">
                                        <label for="number_of_brothers_married">Brother Married</label>
                                        <select name="number_of_brothers_married" id="number_of_brothers_married" class="form-input">
                                            <option value="" selected>Select an option</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ ($profile->number_of_brothers_married == $i) ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Brothers' : 'Brother' }}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('number_of_brothers_married'))
                                        <span class="text-danger small">{{ $errors->first('number_of_brothers_married') }}</span>
                                        @endif   
                                    </div>
                                    <div class="form-group">
                                        <label for="number_of_brothers_unmarried">Brother UnMarried</label>
                                        <select name="number_of_brothers_unmarried" id="number_of_brothers_unmarried" class="form-input">
                                            <option value="" selected>Select an option</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ ($profile->number_of_brothers_unmarried == $i) ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Brothers' : 'Brother' }}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('number_of_brothers_unmarried'))
                                        <span class="text-danger small">{{ $errors->first('number_of_brothers_unmarried') }}</span>
                                        @endif   
                                    </div>
                                    </div>
                                    <div class="pt-5">        
                                                     
                                        <div class="form-group">
                                            <label for="brother_resident_place">Resident Place</label>
                                            <input type="text" class="form-input" name="brother_resident_place"  value="{{ $profile->brother_resident_place }}" id="brother_resident_place" placeholder="Enter Resident Place" >
                                            @if ($errors->has('brother_resident_place'))
                                            <span class="text-danger small">{{ $errors->first('brother_resident_place') }}</span>
                                            @endif             
                                        </div>
                                        
                                        </div> 
                                        </div> 
                                        {{-- sister details --}}
                           <div>
                            
                            <div class="flex items-center justify-between mb-5">
                                <h5 class="font-semibold text-lg dark:text-white-light">Sister Details</h5>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-2">  
                                {{-- <x-text-input name="residentPlace" value="{{ old('residentPlace') }}" :label="__('Resident Place')" :require="false" :messages="$errors->get('residentPlace')"/>                        --}}
                                    <div class="form-group">
                                        <label for="number_of_sisters_married">Sister Married</label>
                                        <select name="number_of_sisters_married" id="number_of_sisters_married" class="form-input">
                                            <option value="" selected>Select an option</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ ($profile->number_of_sisters_married == $i) ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Sisters' : 'Sister' }}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('number_of_sisters_married'))
                                        <span class="text-danger small">{{ $errors->first('number_of_sisters_married') }}</span>
                                        @endif   
                                    </div>
                                    <div class="form-group">
                                        <label for="number_of_sisters_unmarried">Sister UnMarried</label>
                                        <select name="number_of_sisters_unmarried" id="number_of_sisters_unmarried" class="form-input">
                                            <option value="" selected>Select an option</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ ($profile->number_of_sisters_unmarried == $i) ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Sisters' : 'Sister' }}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('number_of_sisters_unmarried'))
                                        <span class="text-danger small">{{ $errors->first('number_of_sisters_unmarried') }}</span>
                                        @endif   
                                    </div>
                                    </div>
                                    <div class="pt-5">        
                                                   
                                            <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-1">  
                                               
                                                <div class="form-group">
                                                    <label for="sister_resident_place">Resident Place</label>
                                                    <input class="form-input" name="sister_resident_place"  value="{{ $profile->sister_resident_place }}" id="sister_resident_place" placeholder="Enter Resident Place" >
                                                    @if ($errors->has('sister_resident_place'))
                                                    <span class="text-danger small">{{ $errors->first('sister_resident_place') }}</span>
                                                    @endif   
                                                 </div>
                                         </div>
                                        </div> 
                                        </div> 

                                        {{-- about parents --}}
                                        <div class="pt-5">        
                                            <div class="panel">
                                                <div class="flex items-center justify-between mb-5">
                                                    <h5 class="font-semibold text-lg dark:text-white-light">About Parents</h5>
                                                </div>               
                                                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                                                    <div class="form-group">
                                                        <label for="about_parents">About Yourself</label>
                                                        <textarea name="about_parents" id="about_parents" class="form-input" placeholder="Tell us about yourself..." >{{ old('about_parents', $profile->about_parents) }}</textarea>
                                                        @if ($errors->has('about_parents'))
                                                        <span class="text-danger small">{{ $errors->first('about_parents') }}</span>
                                                        @endif   
                                                    </div>
                                                </div>    
                                             </div>
                                            </div>
                                            </div>

{{-- astromony --}}
<div class="pt-5">     
    <div class="panel">
        
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Astronomy Details</h5>
        </div>

        
        <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-3">
            
            <div>
                <label for="birth_place">Birth Place</label>
                <input type="text" id="birth_place" name="birth_place" class="form-input" value="{{ $profile->birth_place }}">
                <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
            </div>
           

          
            <div>
                <label for="birth_date">Birth Date</label>
                <input type="date" id="birth_date" name="date_of_birth" class="form-input" value="{{ $profile->date_of_birth }}">
                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
            </div>
             

            
            <div>
                <label for="birth_time">Birth Time</label>
                <input type="time" id="birth_time" name="birth_time" class="form-input" value="{{ $profile->birth_time }}">
                <x-input-error :messages="$errors->get('birth_time')" class="mt-2" />
            </div>
        </div>


        {{-- info --}}


        <div class="pt-5" >     
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Astronomy Information</h5>
                    
                    <div>
                        <!-- Hidden input to ensure 0 is sent when checkbox is unchecked -->
                        <input type="hidden" name="when_meet" value="0" />
                        
                        <!-- Checkbox input -->
                        <input name="when_meet" type="checkbox" value="1"
                               {{ $profile->when_meet ? 'checked' : '' }} 
                               id="toggleDropdowns" />
                        
                        <label class="text-black" for="toggleDropdowns" style="color: black;">
                            भेटल्यावर बोलूया
                        </label>
                    </div>
                </div>
        
                
             
                    <div class="grid grid-cols-2 gap-4 mb-4 md:grid-cols-3">
                        <div>
                             <label for="rashee">राशी</label>
                        <select class="form-input" name="rashee" id="rashee">
                            <option value="" selected>Select an option</option>
                            @foreach (config('data.rashee') as $value => $name)
                                <option value="{{ $value }}" {{ ($profile->rashee === $value) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                            
                        </select>
                        @if ($errors->has('rashee'))
                        <span class="text-danger small">{{ $errors->first('rashee') }}</span>
                        @endif    
                        </div>
        
                        <div class="col">
                            <div class="form-group">
                                <label for="nakshatra">नक्षत्र</label>
                                <select class="form-input" name="nakshatra" id="nakshatra">
                                    <option value="" selected>Select an option</option>
                                    @foreach (config('data.nakshatra', []) as $value => $name)
                                        <option value="{{ $value }}" {{ ($profile->nakshatra === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                    
                                </select>
                                @if ($errors->has('nakshatra'))
                                <span class="text-danger small">{{ $errors->first('nakshatra') }}</span>
                                @endif     
                            </div>
                        </div>
        
                        <div class="col">
                            <div class="form-group">
                                <label for="mangal">मंगळ</label>
                                <select class="form-input" name="mangal" id="mangal">
                                    <option value="" selected>Select an option</option>
                                    @foreach (config('data.mangal', []) as $value => $name)
                                        <option value="{{ $value }}" {{ ($profile->mangal === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                    
                                </select>
                                @if ($errors->has('mangal'))
                                <span class="text-danger small">{{ $errors->first('mangal') }}</span>
                                @endif     
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="charan">चरण</label>
                            <select class="form-input" name="charan" id="charan">
                                <option value="" selected>Select an option</option>
                                @foreach (config('data.charan', []) as $value => $name)
                                    <option value="{{ $value }}" {{ ($profile->charan === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                                
                            </select>
                            @if ($errors->has('charan'))
                            <span class="text-danger small">{{ $errors->first('charan') }}</span>
                            @endif     
                        </div>
                        <div class="form-group">
                            <label for="gana">गण</label>
                            <select class="form-input" name="gana" id="gana">
                                <option value="" selected>Select an option</option>
                                @foreach (config('data.gana', []) as $value => $name)
                                    <option value="{{ $value }}" {{ ($profile->gana === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                                
                            </select>
                            @if ($errors->has('gana'))
                            <span class="text-danger small">{{ $errors->first('gana') }}</span>
                            @endif     
                        </div>
                        <div class="form-group">
                            <label for="nadi">नाडी</label>
                            <select class="form-input" name="nadi" id="nadi">
                                <option value="" selected>Select an option</option>
                                @foreach (config('data.nadi', []) as $value => $name)
                                    <option value="{{ $value }}" {{ ($profile->nadi === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                                
                            </select>
                            @if ($errors->has('nadi'))
                            <span class="text-danger small">{{ $errors->first('nadi') }}</span>
                            @endif     
                        </div>
                    </div>
            </div> 
        </div>
        </div>

        {{-- educational --}}
        <div class="pt-5">        
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Educational Information</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                    <div class="form-group">
                        <label for="highest_education">Highest Education</label>
                        <select name="highest_education" class="form-input" id="highest_education">
                            <option value="" selected>Select an option</option>
                            @foreach (config('data.highest_education', []) as $value => $name)
                                <option value="{{ $value }}" {{ ($profile->highest_education === $value) ? 'selected' : '' }}>{{ $name }}</option>          
                                        
                            @endforeach
                            <option value="other" {{ (old('highest_education', $profile->highest_education) === 'other') ? 'selected' : '' }}>Other</option>
                        </select>
                    
                        <!-- Other input box appears only if 'Other' is selected -->
                        <div id="other-education" style="display: {{ (old('highest_education', $profile->highest_education) === 'other') ? 'block' : 'none' }};">
                            <label for="other_education">Please specify</label>
                            <input type="text" name="other_education" id="other_education" class="form-input" value="{{ old('other_education', $profile->other_education) }}">
                        </div>
                    
                        @if ($errors->has('highest_education'))
                            <span class="text-danger small">{{ $errors->first('highest_education') }}</span>
                        @endif
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const highestEducationSelect = document.getElementById('highest_education');
                            const otherEducationDiv = document.getElementById('other-education');
                    
                            // Show or hide the input field based on 'Other' selection
                            if (highestEducationSelect.value === 'other') {
                                otherEducationDiv.style.display = 'block';
                            }
                    
                            highestEducationSelect.addEventListener('change', function () {
                                if (this.value === 'other') {
                                    otherEducationDiv.style.display = 'block';
                                } else {
                                    otherEducationDiv.style.display = 'none';
                                }
                            });
                        });
                    </script>
                    
                    
                    <div>
                        <label for="education_in_detail">Education in Detail</label> 
                        <input class="form-input" type="text" name="education_in_detail" value="{{$profile->education_in_detail}}" id="education_in_detail" placeholder="Enter education in detail" >
                        @if ($errors->has('education_in_detail'))
                        <span class="text-danger small">{{ $errors->first('education_in_detail') }}</span>
                        @endif  
                    </div>  
                    <div>
                        <label for="additional_degree">Additional Degree</label> 
                        <input class="form-input" type="text" name="additional_degree" value="{{$profile->additional_degree}}" id="additional_degree" placeholder="Enter education in detail" >
                        @if ($errors->has('additional_degree'))
                        <span class="text-danger small">{{ $errors->first('additional_degree') }}</span>
                        @endif  
                    </div> 
                     
                    
                </div>    
             </div>
            </div>     
        <div class="pt-5">        
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Occupational Information</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                    <div class="form-group">
                        <label for="occupation">Occupation</label>
                        <select class="form-input" name="occupation" id="occupation">
                            <option value="" selected>Select an option</option>
                            @foreach (config('data.occupation', []) as $value => $name)
                                <option value="{{$value}}" {{ ($profile->occupation === $value) ? 'selected' : ''}} >{{ $name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('occupation'))
                        <span class="text-danger small">{{ $errors->first('occupation') }}</span>
                        @endif  
                    </div>
                    <div class="form-group">
                        <label for="organization">Organisation</label>
                        <input type="text" name="organization" value="{{$profile->organization}}" id="organization" class="form-input" placeholder="Enter Organization">
                        @if ($errors->has('organization'))
                        <span class="text-danger small">{{ $errors->first('organization') }}</span>
                        @endif  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" name="designation" value="{{$profile->designation}}" id="designation" class="form-input" placeholder="Enter designation">
                            @if ($errors->has('designation'))
                            <span class="text-danger small">{{ $errors->first('designation') }}</span>
                            @endif  
                        </div>
                    </div>
                    <div>
                        <label for="job_location">Job Location</label>
                        <input type="text" id="job_location" name="job_location" class="form-input" value="{{ $profile->job_location }}">
                        <x-input-error :messages="$errors->get('job_location')" class="mt-2" />
                    </div>  
                     
                     
                    
                </div>    
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Experience / Income Information</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                    {{-- <div>
                        <label>Currency</label>
                        <select class="form-input" name="currency" x-model="currency" id="currency">
                            <option value="" selected>Select an option</option>
                            <option value="inr">INR</option> 
                            <option value="usd">USD</option>
                            <option value="aed">AED</option>
                        </select> 
                        <x-input-error :messages="$errors->get('eating_habits')" class="mt-2" /> 
                    </div>  --}}
                    <div>
                        <label for="job_experience">Job Experience</label>
                        <input type="text" id="job_experience" name="job_experience" class="form-input" value="{{ $profile->job_experience }}">
                         <x-input-error :messages="$errors->get('job_experience')" class="mt-2" />
                    </div>  
                    <div>
                        <label for="income">Income (in INR)</label>
                        <input type="number" name="income" class="form-input" value="{{ old('income', $profile->income) }}">
                        <x-input-error :messages="$errors->get('income')" class="mt-2" />
                    </div>  
                </div>    
             </div>
            </div>     
        <div class="pt-5">        
            <div class="panel">
                <h1>Contact Details</h1>
                <div class="flex items-center justify-between mb-5">
                   
                    <h5 class="font-semibold text-lg dark:text-white-light">Location Information</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="form-input" name="country" id="country">
                            <option value="" selected>Select an option</option>
                            @foreach (config('data.country', []) as $value => $name)
                                <option value="{{ $value }}" {{ ($profile->country === $value) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                            <span class="text-danger small">{{ $errors->first('country') }}</span>
                        @endif  
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-input" name="state" id="state">
                            <option value="" selected>Select an option</option>
                            @foreach (config('data.state', []) as $value => $name)
                                <option value="{{ $value }}" {{ ($profile->state === $value) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('state'))
                            <span class="text-danger small">{{ $errors->first('state') }}</span>
                        @endif  
                    </div>
                    
                    <div>
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" class="form-input" value="{{ $profile->city }}">
                         <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div> 
                     
                </div>    
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Address / Contact Information</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                    
                    <div>
                        <label for="address_line_1">Address Line 1</label>
                        <input type="text" id="address_line_1" name="address_line_1" class="form-input" value="{{ $profile->address_line_1 }}">
                         <x-input-error :messages="$errors->get('address_line_1')" class="mt-2" />
                    </div>  
                    <div>
                        <label for="address_line_2">Address Line 2</label>
                        <input type="text" id="address_line_2" name="address_line_2" class="form-input" value="{{ $profile->address_line_2 }}">
                         <x-input-error :messages="$errors->get('address_line_2')" class="mt-2" />
                    </div>  
                    <div>
                        <label for="landmark">Landmark</label>
                        <input type="text" id="landmark" name="landmark" class="form-input" value="{{ $profile->landmark }}">
                         <x-input-error :messages="$errors->get('landmark')" class="mt-2" />
                    </div>  
                    <div>
                        <label for="pincode">Pincode</label>
                        <input type="text" id="pincode" name="pincode" class="form-input" value="{{ $profile->pincode }}">
                         <x-input-error :messages="$errors->get('pincode')" class="mt-2" />
                    </div>  
                    <div>
                        <label for="mobile">Mobile</label>
                        <div class="flex items-center">
                             <input type="text" id="mobile" name="mobile" class="form-input" value="{{ $profile->mobile }}"
                                   placeholder="Enter mobile number" pattern="^\[0-9]{10}$" 
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                                   required>
                        </div>
                        <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                  const mobileInput = document.getElementById("mobile");
                                
                                  // Case 1: When the user types the first digit into an empty field,
                                  // automatically insert "+91" before that digit.
                                  mobileInput.addEventListener("keydown", function(e) {
                                    // Only proceed if the field is empty and the key pressed is a single digit (0-9)
                                    if (mobileInput.value === "" && /^[0-9]$/.test(e.key)) {
                                      e.preventDefault();  // Prevent the digit from being added normally.
                                      mobileInput.value = "+91" + e.key;
                                      // Place the caret at the end of the input.
                                      mobileInput.setSelectionRange(mobileInput.value.length, mobileInput.value.length);
                                    }
                                  });
                                
                                  // Case 2: In case the user pastes a number or edits the field manually,
                                  // add "+91" if the value starts with a digit but doesn't already have the prefix.
                                  mobileInput.addEventListener("blur", function() {
                                    let value = mobileInput.value.trim();
                                    if (value && /^[0-9]/.test(value) && !value.startsWith('+91')) {
                                      mobileInput.value = "+91" + value;
                                    }
                                  });
                                });
                                </script>
                    </div>
                    <div>
                        <label for="landline">Landline</label>
                        <input type="text" id="landline" name="landline" class="form-input" value="{{ $profile->landline }}">
                         <x-input-error :messages="$errors->get('landline')" class="mt-2" />
                    </div>  
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ $profile->email }}" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    
                </div>    
             </div>
            </div>     
        <div class="pt-5">        
            <div class="panel">
                <h1>About Life Partner Profile</h1>
                <div class="flex items-center justify-between mb-5">
                   
                    <h5 class="font-semibold text-lg dark:text-white-light">Age / Height Information</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">  
                    <div class="col">
                        @if($profile->role === 'bride')
                    <div class="col">
                        <div class="form-group">
                            <label for="partner_min_age">Min Age</label>
                            <select name="partner_min_age" id="partner_min_age" class="form-input">
                                <option value="" selected>select an option</option>
                                @if (config('data.partner_min_age'))
                                    @foreach (config('data.partner_min_age') as $value => $name)
                                        <option value="{{$value}}" {{ ($profile->partner_min_age === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('partner_min_age'))
                            <span class="text-danger small">{{ $errors->first('partner_min_age') }}</span>
                            @endif  
                        </div>
                    </div>
                    @else 
                    <div class="col">
                        <div class="form-group">
                            <label for="partner_min_age">Min Age</label>
                            <select name="partner_min_age" id="partner_min_age" class="form-input">
                                <option value="" selected>select an option</option>
                                @if (config('data.bride_min_age'))
                                    @foreach (config('data.bride_min_age') as $value => $name)
                                        <option value="{{$value}}" {{ ($profile->partner_min_age === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('partner_min_age'))
                            <span class="text-danger small">{{ $errors->first('partner_min_age') }}</span>
                            @endif  
                        </div>
                    </div>
                    @endif
                    </div>
                    <div class="form-group">
                        <label for="partner_max_age">Max Age</label>
                        <select name="partner_max_age" id="partner_max_age" class="form-input">
                            <option value="" selected>select an option</option>
                            @if (config('data.partner_max_age'))
                                @foreach (config('data.partner_max_age') as $value => $name)
                                    <option value="{{$value}}" {{ ($profile->partner_max_age === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('partner_max_age'))
                        <span class="text-danger small">{{ $errors->first('partner_max_age') }}</span>
                        @endif  
                    </div>
                    <div class="form-group">
                        <label for="partner_min_height">Min Height</label>
                        <select name="partner_min_height" id="partner_min_height" class="form-input">
                            <option value="" selected>select an option</option>
                            @if (config('data.partner_min_height'))
                                @foreach (config('data.partner_min_height') as $value => $name)
                                    <option value="{{$value}}" {{ ($profile->partner_min_height === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('partner_min_height'))
                        <span class="text-danger small">{{ $errors->first('partner_min_height') }}</span>
                        @endif 
                    </div>
                    <div class="form-group">
                        <label for="partner_max_height">Max Height</label>
                        <select name="partner_max_height" id="partner_max_height" class="form-input">
                            <option value="" selected>select an option</option>
                            @if (config('data.partner_max_height'))
                                @foreach (config('data.partner_max_height') as $value => $name)
                                    <option value="{{$value}}" {{ ($profile->partner_max_height === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                @endforeach
                            @endif
                            
                        </select>
                        @if ($errors->has('partner_max_height'))
                        <span class="text-danger small">{{ $errors->first('partner_max_height') }}</span>
                        @endif 
                    </div>
                     
                </div>   
                 
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Expected Information About Partners</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">  
                    
                    <div>
                        <label for="partner_income">Income (in INR)</label>
                        <input type="text" id="partner_income" name="partner_income" class="form-input" value="{{ $profile->partner_income }}">
                         <x-input-error :messages="$errors->get('partner_income')" class="mt-2" />
                    </div>  
                    <div class="form-group">
                        <label for="partner_city_preference">City Preference</label>
                        <input class="form-input" type="text" name="partner_city_preference"  value="{{ $profile->partner_city_preference }}" id="partner_city_preference" placeholder="Enter City Preference" >
                        @if ($errors->has('partner_city_preference'))
                        <span class="text-danger small">{{ $errors->first('partner_city_preference') }}</span>
                        @endif  
                </div>
                     
                <div class="form-group">
                    <label for="partner_currency">Currency</label>
                    <select name="partner_currency" id="partner_currency" class="form-input">
                        <option value="" selected>select an option</option>
                        @if (config('data.partner_currency'))
                            @foreach (config('data.partner_currency') as $value => $name)
                                <option value="{{$value}}" {{ ($profile->partner_currency === $value) ? 'selected' : ''}} >{{ $name }}</option>
                            @endforeach
                        @endif
                        
                    </select>
                    @if ($errors->has('partner_currency'))
                <span class="text-danger small">{{ $errors->first('partner_currency') }}</span>
                @endif 
                </div>
                    <div class="form-group">
                        <label for="want_to_see_patrika">Want to see Patrika</label>
                        <select class="form-input" name="want_to_see_patrika" id="want_to_see_patrika">
                            <option value="" selected>Select an option</option>
                            <!-- Correct string comparison for 'yes' and 'no' -->
                            <option value="yes" {{ $profile->want_to_see_patrika === 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $profile->want_to_see_patrika === 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @if ($errors->has('want_to_see_patrika'))
                        <span class="text-danger small">{{ $errors->first('want_to_see_patrika') }}</span>
                        @endif 
                    </div>
                    <div class="form-group">
                        <label for="partner_sub_cast">SubCast</label>
                        <select class="form-input" name="partner_sub_cast" id="partner_sub_cast">
                            <option value="" selected>Select an option</option>
                            <!-- Correct string comparison for 'yes' and 'no' -->
                            <option value="yes" {{ $profile->partner_sub_cast === 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $profile->partner_sub_cast === 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @if ($errors->has('partner_sub_cast'))
                        <span class="text-danger small">{{ $errors->first('partner_sub_cast') }}</span>
                        @endif         
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="partner_education">Education</label>
                            <input class="form-input" type="text" name="partner_education"  value="{{ $profile->partner_education }}" id="partner_education" placeholder="Enter Education" >
                            @if ($errors->has('partner_education'))
                            <span class="text-danger small">{{ $errors->first('partner_education') }}</span>
                            @endif  
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="partner_job">Job</label>
                        <select class="form-input" name="partner_job" id="partner_job">
                            <option value="" selected>Select an option</option>
                            <!-- Correct string comparison for 'yes' and 'no' -->
                            <option value="yes" {{ $profile->partner_job === 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $profile->partner_job === 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @if ($errors->has('partner_job'))
                        <span class="text-danger small">{{ $errors->first('partner_job') }}</span>
                        @endif  
                    </div>
                    <div class="form-group">
                        <label for="partner_business">Business</label>
                        <select class="form-input" name="partner_business" id="partner_business">
                            <option value="" selected>Select an option</option>
                            <!-- Correct string comparison for 'yes' and 'no' -->
                            <option value="yes" {{ $profile->partner_business === 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $profile->partner_business === 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @if ($errors->has('partner_business'))
                        <span class="text-danger small">{{ $errors->first('partner_business') }}</span>
                        @endif  
                    </div>
                    <div class="form-group">
                        <label for="partner_foreign_resident">Foreign resident</label>
                        <select class="form-input" name="partner_foreign_resident" id="partner_foreign_resident">
                            <option value="" selected>Select an option</option>
                            <!-- Correct string comparison for 'yes' and 'no' -->
                            <option value="yes" {{ $profile->partner_foreign_resident === 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $profile->partner_foreign_resident === 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @if ($errors->has('partner_foreign_resident'))
                        <span class="text-danger small">{{ $errors->first('partner_foreign_resident') }}</span>
                        @endif            
                  </div>
                  <div class="form-group">
                    <label for="partner_eating_habbit">Eating Habbits</label>
                    <select class="form-input" name="partner_eating_habbit" id="partner_eating_habbit">
                        <option value="" selected>Select an option</option>
                        @foreach (config('data.partner_eating_habbit', []) as $value => $name)
                            <option value="{{ $value }}" {{ ($profile->partner_eating_habbit === $value) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('partner_eating_habbit'))
                    <span class="text-danger small">{{ $errors->first('partner_eating_habbit') }}</span>
                    @endif    
                </div>
                    
                    
                    
                    
                </div>    
             </div>
            </div>     



                        </div>
                    </div> 
                    
                        {{-- submit --}}
                        <div class="flex justify-end mt-4">
                            <x-success-button>
                                {{ __('Submit') }}
                            </x-success-button>                    
                            &nbsp;&nbsp;
                            <x-cancel-button :link="route('castes.index')">
                                {{ __('Cancel') }}
                            </x-cancel-button>
                        </div> 
        </form>         
       </div>
    </div> 
    </div> 

    <script>
        // img
        function imageLoader() {
            return {
                imageUrl: null,
    
                async fetchImage(filename) {
                    try {
                        const response = await fetch(`/api/images/${filename}`);
                        if (!response.ok) throw new Error('Image not found');
                        
                        // Create a blob URL for the image
                        const blob = await response.blob();
                        this.imageUrl = URL.createObjectURL(blob);
                    } catch (error) {
                        console.error('Error fetching image:', error);
                        this.imageUrl = null; // Handle error case
                    }
                }
            };
        }
    </script>
    <script>
        document.getElementById('toggleDropdowns').addEventListener('change', function() {
        const dropdowns = document.getElementById('dropdowns');
    
        if (this.checked) {
            dropdowns.style.display = 'none'; // Hide dropdowns
        } else {
            dropdowns.style.display = 'block'; // Show dropdowns
        }
    });
    
     </script> 
    </x-layout.admin>
    