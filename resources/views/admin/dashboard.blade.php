<x-layout.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Total Registered Users -->
                <div class="bg-white shadow-lg rounded-lg p-4 w-32 h-32 flex flex-col justify-center items-center">
                    <h3 class="text-sm font-semibold text-gray-800 text-center">Registered Users</h3>
                    <p class="text-xs text-gray-600 text-center mt-1">Total users</p>
                    <p class="text-2xl font-bold text-blue-500 mt-2">{{ $totalUsers }}</p>
                </div>
            
                <!-- Active Users -->
                <div class="bg-blue-100 shadow-lg rounded-lg p-4 w-32 h-32 flex flex-col justify-center items-center">
                    <h3 class="text-sm font-semibold text-gray-800 text-center">Active Groom Users</h3>
                    <p class="text-xs text-gray-600 text-center mt-1">Currently active</p>
                    <p class="text-2xl font-bold text-blue-500 mt-2">{{ $activeMaleUsers }}</p>
                </div>
                
                <div class="bg-pink-100 shadow-lg rounded-lg p-4 w-32 h-32 flex flex-col justify-center items-center">
                    <h3 class="text-sm font-semibold text-gray-800 text-center">Active Bride Users</h3>
                    <p class="text-xs text-gray-600 text-center mt-1">Currently active</p>
                    <p class="text-2xl font-bold text-pink-500 mt-2">{{ $activeFemaleUsers }}</p>
                </div>
                
            
                <!-- Inactive Users -->
                <div class="bg-red-100 shadow-lg rounded-lg p-4 w-32 h-32 flex flex-col justify-center items-center">
                    <h3 class="text-sm font-semibold text-gray-800 text-center">Inactive Users</h3>
                    <p class="text-xs text-gray-600 text-center mt-1">Not active</p>
                    <p class="text-2xl font-bold text-red-500 mt-2">{{ $inactiveUsers }}</p>
                </div>
            
            
            </div>



            <div class="mt-8 bg-yellow-100 shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-800">⚠️ Packages Expiring This Month</h3>
                <p class="text-lg text-gray-600 mt-2">List of users whose packages will expire this month.</p>
            
                @php
                    $expiringThisMonth = $expiringPackages->filter(function($package) {
                        return \Carbon\Carbon::parse($package->expires_at)->format('Y-m') === now()->format('Y-m');
                    });
            
                    $displayedPackages = $expiringThisMonth->take(3); // Show only 5 initially
                    $hasMore = $expiringThisMonth->count() > 3; // Check if there are more than 5
                @endphp
            
                @if($expiringThisMonth->isEmpty())
                    <p class="text-gray-500 mt-4">No packages expiring this month.</p>
                @else
                    <div class="overflow-x-auto mt-4">
                        <table class="w-full table-auto border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 px-4 py-2 text-left">User Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Package Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($displayedPackages as $package)
                                @php $user = $package->profile->user ?? null; @endphp
                                <tr class="bg-white">
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{-- {{ $user ? $user->first_name ' ' . $user->last_name : 'N/A' }} --}}
                                        {{ $user->name }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $user->email ?? 'N/A' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ \Carbon\Carbon::parse($package->expires_at)->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
            
                    @if($hasMore)
                        <div class="mt-4 text-right">
                            <a href="{{ route('admin.expiring-packages') }}" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                Show More →
                            </a>
                        </div>
                    @endif
                @endif
            </div>
            
            

         <!-- Birthday Users -->
<div class="mt-8 bg-white shadow-lg rounded-lg p-6">
    <h3 class="text-2xl font-semibold text-gray-800">🎂 Members with Birthdays This Month</h3>
    <p class="text-lg text-gray-600 mt-2">Celebrate with these members!</p>

    @if($birthdayUsers->isEmpty())
        <p class="text-gray-500 mt-4">No birthdays this month.</p>
    @else
        <div class="overflow-x-auto mt-4">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">Full Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Mobile</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date of Birth</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($birthdayUsers as $user)
                    <tr class="bg-white">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $user->mobile ?? 'N/A' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $user->email ?? 'N/A' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ \Carbon\Carbon::parse($user->date_of_birth)->format('M d') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(@$hasMoreBirthdays)
            <div class="mt-4 text-right">
                <a href="{{ route('admin.birthdays') }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Show More →
                </a>
            </div>
        @endif
    @endif
</div>


            
          
            
            

        </div>
    </div>
</x-layout.admin>   
