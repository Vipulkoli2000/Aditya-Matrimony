<x-layout.admin>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('cities.index') }}" class="text-primary hover:underline">Cities</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5">        
        <form class="space-y-5" action="{{ route('cities.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add City</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     
                    <x-text-input name="name" value="{{ old('name') }}" :label="__('City Name')" :require="true" :messages="$errors->get('name')"/>                       
                </div>
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>                    
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('cities.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>
            </div>            
        </form>         
    </div>
</div> 
</x-layout.admin>
