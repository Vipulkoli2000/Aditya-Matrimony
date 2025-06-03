<x-layout.admin>
    <div class="container mx-auto p-6">
        <!-- Flex container for heading and search -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">🎉 All Birthdays This Month</h2>
                <p class="text-lg text-gray-600 mt-2">Here are all the members celebrating their birthday this month.</p>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.birthdays') }}" class="flex">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search by name..." 
                    class="border rounded-lg p-2 w-60"
                >
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg">Search</button>
            </form>
        </div>

        @if($birthdayUsers->isEmpty())
            <p class="text-gray-500 mt-4">No birthdays this month.</p>
        @else
            <div class="overflow-x-auto">
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
                                    {{ $user->first_name }} 
                                    {{ $user->middle_name ? $user->middle_name . ' ' : '' }} 
                                    {{ $user->last_name }}
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
        @endif
    </div>
</x-layout.admin>
