<x-layout.admin>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('sub_castes.index') }}" class="text-primary hover:underline">Sub-Castes</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5">        
        <form class="space-y-5" action="{{ route('sub_castes.update', ['sub_caste' => $sub_caste->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Sub-Caste</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">               
                    <div>
                        <label for="caste_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Caste <span class="text-red-500">*</span></label>
                        <select name="caste_id" id="caste_id" class="form-select" required>
                            <option value="">Select Caste</option>
                            @foreach($castes as $caste)
                                <option value="{{ $caste->id }}" {{ old('caste_id', $sub_caste->caste_id) == $caste->id ? 'selected' : '' }}>
                                    {{ $caste->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('caste_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-text-input name="name" value="{{ old('name', $sub_caste->name) }}" :label="__('Sub-Caste Name')" :require="true" :messages="$errors->get('name')"/>              
                </div>
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('sub_castes.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>
            </div>
        </form> 
    </div>
</div>
</x-layout.admin>
