<x-layout.admin>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('castes.index') }}" class="text-primary hover:underline">Castes</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5">        
        <form class="space-y-5" action="{{ route('castes.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Caste</h5>
                </div>               
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     
                    <x-text-input name="name" value="{{ old('name') }}" :label="__('Caste Name')" :require="true" :messages="$errors->get('name')"/>                       
                </div>
                
                <!-- Subcaste Section -->
                <div class="mt-6">
                    <h6 class="font-semibold text-md dark:text-white-light mb-3">Sub-Castes</h6>
                    @error('subcastes')
                        <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                    @enderror
                    <div id="subcaste-container">
                        @if(old('subcastes'))
                            @foreach(old('subcastes') as $index => $subcaste)
                                <div class="subcaste-row flex gap-2 mb-2">
                                    <input type="text" name="subcastes[]" value="{{ $subcaste }}" class="form-input flex-1" placeholder="Enter subcaste name" required>
                                    <button type="button" class="btn btn-danger remove-subcaste">Remove</button>
                                </div>
                            @endforeach
                        @else
                            <div class="subcaste-row flex gap-2 mb-2">
                                <input type="text" name="subcastes[]" class="form-input flex-1" placeholder="Enter subcaste name" required>
                                <button type="button" class="btn btn-danger remove-subcaste">Remove</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" id="add-subcaste" class="btn btn-secondary mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add Another Subcaste
                    </button>
                </div>
                
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>                    
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('castes.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>
            </div>            
        </form>         
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('subcaste-container');
        const addButton = document.getElementById('add-subcaste');
        
        // Add new subcaste row
        addButton.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.className = 'subcaste-row flex gap-2 mb-2';
            newRow.innerHTML = `
                <input type="text" name="subcastes[]" class="form-input flex-1" placeholder="Enter subcaste name" required>
                <button type="button" class="btn btn-danger remove-subcaste">Remove</button>
            `;
            container.appendChild(newRow);
            attachRemoveHandler(newRow.querySelector('.remove-subcaste'));
        });
        
        // Attach remove handler to existing remove buttons
        document.querySelectorAll('.remove-subcaste').forEach(button => {
            attachRemoveHandler(button);
        });
        
        function attachRemoveHandler(button) {
            button.addEventListener('click', function() {
                const rows = container.querySelectorAll('.subcaste-row');
                if (rows.length > 1) {
                    button.closest('.subcaste-row').remove();
                } else {
                    alert('At least one subcaste field must remain.');
                }
            });
        }
    });
</script>
</x-layout.admin>
