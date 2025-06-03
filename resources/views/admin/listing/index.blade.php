<x-layout.admin>
    <div class="flex items-center justify-between mb-5">
        <h5 class="font-semibold text-lg dark:text-white-light">Wedding Listings</h5>
    </div>

    <div class="panel">
        <div class="mb-5">
            <form action="{{ route('listing.index') }}" method="get" class="flex items-center">
                <input type="text" name="search" placeholder="Search listings..." class="form-input" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary ml-2">Search</button>
                <a href="{{ route('listing.create') }}" class="btn btn-primary ml-2">
                    <svg class="w-5 h-5 ltr:mr-2 rtl:ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Create
                </a>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table-hover">
                <thead>
                    <tr>
                        <th>Business Name</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th class="text-end actions-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listings as $listing)
                        <tr>
                            <td>{{ $listing->business_name }}</td>
                            <td>{{ $listing->category->listing_category }}</td>
                            <td>{{ $listing->city }}, {{ $listing->state }}</td>
                            <td>{{ $listing->mobile }}</td>
                            <td class="text-end actions-column">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('listing.show', $listing->id) }}" class="btn btn-outline-info shadow-lg transform hover:-translate-y-1 transition-transform duration-200" style="box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08); border-bottom: 3px solid #0ea5e9;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                            <path d="M12 5C8.25 5 5.0925 7.32 3.4725 10.9C3.46349 10.9172 3.45846 10.9352 3.45756 10.9537C3.45666 10.9722 3.4599 10.9905 3.46715 11.0078C3.4744 11.025 3.48553 11.0409 3.49998 11.0545C3.51443 11.068 3.53193 11.0789 3.5513 11.0865C3.5707 11.0942 3.59154 11.0985 3.61267 11.0992C3.63381 11.0999 3.65494 11.0969 3.67494 11.0904C3.69493 11.0839 3.71371 11.0742 3.72994 11.0618C3.74617 11.0494 3.75947 11.0346 3.76909 11.018C5.27659 7.722 8.172 5.5 12 5.5C15.828 5.5 18.7234 7.722 20.2309 11.018C20.2405 11.0346 20.2538 11.0494 20.2701 11.0618C20.2863 11.0742 20.3051 11.0839 20.3251 11.0904C20.3451 11.0969 20.3662 11.0999 20.3873 11.0992C20.4085 11.0985 20.4293 11.0942 20.4487 11.0865C20.4681 11.0789 20.4856 11.068 20.5 11.0545C20.5145 11.0409 20.5256 11.025 20.5329 11.0078C20.5401 10.9905 20.5433 10.9722 20.5424 10.9537C20.5415 10.9352 20.5365 10.9172 20.5275 10.9C18.9075 7.32 15.75 5 12 5Z" fill="currentColor"/>
                                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="currentColor"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('listing.edit', $listing->id) }}" class="btn btn-outline-primary shadow-lg transform hover:-translate-y-1 transition-transform duration-200" style="box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08); border-bottom: 3px solid #2563eb;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                            <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('listing.destroy', $listing->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger shadow-lg transform hover:-translate-y-1 transition-transform duration-200" style="box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08); border-bottom: 3px solid #dc2626;">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                                <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path opacity="0.5" d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6" stroke="currentColor" stroke-width="1.5" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No listings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $listings->links() }}
        </div>
    </div>
</x-layout.admin>
