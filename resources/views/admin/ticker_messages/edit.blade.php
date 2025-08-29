<x-layout.admin>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <span class="text-primary">Settings</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Ticker Message</span>
            </li>
        </ul>

        <div class="pt-5">
            <form class="space-y-5" action="{{ route('admin.ticker.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Global Ticker Message</h5>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mb-4">
                        <div>
                            <label for="message" class="block mb-1">Message</label>
                            <textarea id="message" name="message" rows="3" class="form-input" placeholder="Type announcement to show in the ticker...">{{ old('message', $message) }}</textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-success-button>
                            {{ __('Save') }}
                        </x-success-button>
                    </div>
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="mt-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif
    </div>
</x-layout.admin>
