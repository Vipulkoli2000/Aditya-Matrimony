<x-layout.admin>
    <div class="container mx-auto px-4 py-8">
        <div class="panel">
            <div class="text-center py-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    Welcome, {{ $franchise->name }}!
                </h1>
                <p class="text-lg text-gray-600">
                    You are logged in as a Franchise user.
                </p>
                <p class="text-md text-gray-500 mt-2">
                    Franchise Code: {{ $franchise->franchise_code }}
                </p>
            </div>
        </div>
    </div>
</x-layout.admin>
