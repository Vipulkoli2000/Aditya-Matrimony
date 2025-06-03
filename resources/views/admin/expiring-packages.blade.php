<x-layout.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expiring Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-800">⚠️ All Packages Expiring This Month</h3>
            <p class="text-lg text-gray-600 mt-2">Below is the list of users whose packages will expire this month.</p>

            @if($expiringPackages->isEmpty())
                <p class="text-gray-500 mt-4">No packages expiring this month.</p>
            @else
                <div class="overflow-x-auto mt-4">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2 text-left">User Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Mobile Number</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Package Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expiringPackages as $package)
                                <tr class="bg-white">
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $package->profile->user->first_name ?? 'N/A' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $package->profile->user->email ?? 'N/A' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $package->profile->mobile ?? 'N/A' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ \Carbon\Carbon::parse($package->expires_at)->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                        
                    </table>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-layout.admin>
