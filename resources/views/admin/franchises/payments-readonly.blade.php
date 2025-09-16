<x-layout.admin>
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">
                Payment Tracking - {{ $franchise->name }}
            </h5>
            <div class="flex items-center gap-2">
                <form method="GET" action="{{ route('franchise.payments') }}" class="flex items-center gap-2">
                    <select name="year" class="form-select scrollbar-hide" onchange="this.form.submit()" style="scrollbar-width: none; -ms-overflow-style: none;">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('user_profiles.index') }}" class="btn btn-secondary">Back to Profiles</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2">
                <div class="panel border">
                    <div class="p-4">
                        <h6 class="font-semibold mb-3">Franchise Details</h6>
                        <div class="space-y-2 text-sm">
                            <div><strong>Code:</strong> {{ $franchise->franchise_code }}</div>
                            <div><strong>Email:</strong> {{ $franchise->email }}</div>
                            <div><strong>Mobile:</strong> {{ $franchise->mobile }}</div>
                            <div><strong>Location:</strong> {{ $franchise->location }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="panel border">
                    <div class="p-4">
                        <h6 class="font-semibold mb-3">Payment Summary {{ $currentYear }}</h6>
                        <div class="space-y-2 text-sm">
                            <div><strong>Paid Months:</strong> <span id="paid-count">{{ $payment->paid_months_count }}</span> / 12</div>
                            <div><strong>Pending Months:</strong> <span id="pending-count">{{ 12 - $payment->paid_months_count }}</span></div>
                            <div class="mt-2">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-primary h-2.5 rounded-full" style="width: {{ ($payment->paid_months_count / 12) * 100 }}%;" id="progress-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="p-5">
                <h6 class="font-semibold mb-4">Monthly Payment Status for {{ $currentYear }}</h6>
                
                @php
                    $months = [
                        'january' => 'January',
                        'february' => 'February', 
                        'march' => 'March',
                        'april' => 'April',
                        'may' => 'May',
                        'june' => 'June',
                        'july' => 'July',
                        'august' => 'August',
                        'september' => 'September',
                        'october' => 'October',
                        'november' => 'November',
                        'december' => 'December'
                    ];
                @endphp
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($months as $key => $month)
                    <div class="flex items-center p-3 border rounded-lg {{ $payment->$key ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200' }}">
                        <div class="flex items-center">
                            @if($payment->$key)
                                <svg class="h-5 w-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                            <span class="text-sm font-medium {{ $payment->$key ? 'text-green-700' : 'text-gray-700' }}">
                                {{ $month }}
                            </span>
                        </div>
                        <div class="ml-auto">
                            @if($payment->$key)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Paid
                                </span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-layout.admin>
