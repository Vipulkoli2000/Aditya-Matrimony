<x-layout.admin>
<div class="flex justify-between items-center mb-5">
    <h5 class="font-semibold text-lg dark:text-white-light">Add Listing Category</h5>
    <a href="{{ route('listing-categories.index') }}" class="btn btn-outline-primary">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
            <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Back to List
    </a>
</div>
<div class="panel">
    <div class="panel-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('listing-categories.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="mb-5">
                <label for="listing_category" class="form-label">Category Name</label>
                <input type="text" id="listing_category" name="listing_category" class="form-input" value="{{ old('listing_category') }}" required>
            </div>
            <button type="submit" class="btn btn-primary !mt-6">Create Category</button>
        </form>
    </div>
</div>
</x-layout.admin>
