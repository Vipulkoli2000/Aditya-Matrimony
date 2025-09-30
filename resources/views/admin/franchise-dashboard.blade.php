<x-layout.admin>
    <div class="panel">
        <h5 class="font-semibold text-lg dark:text-white-light mb-6">
            {{ Auth::guard('franchise')->check() ? 'Franchise Dashboard' : 'Dashboard Summary' }}
        </h5>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 rounded-lg border border-gray-200 dark:border-[#1b2e4b] bg-white dark:bg-[#0e1726] shadow-sm">
                <div class="text-gray-500 dark:text-white-light text-sm mb-2">Profiles Created This Month</div>
                <div class="text-3xl font-bold text-primary">{{ number_format($monthlyProfiles) }}</div>
            </div>

            <div class="p-6 rounded-lg border border-gray-200 dark:border-[#1b2e4b] bg-white dark:bg-[#0e1726] shadow-sm">
                <div class="text-gray-500 dark:text-white-light text-sm mb-2">Total Profiles Overall</div>
                <div class="text-3xl font-bold text-primary">{{ number_format($totalProfiles) }}</div>
            </div>
        </div>

        <div class="mt-8 text-xs text-gray-500 dark:text-white-light">
            <span class="inline-block mr-2">Period:</span>
            <span>{{ now()->startOfMonth()->format('d-m-Y') }} - {{ now()->endOfMonth()->format('d-m-Y') }}</span>
        </div>
    </div>
</x-layout.admin>
