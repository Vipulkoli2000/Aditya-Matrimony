<x-layout.admin>
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">
                Payment Tracking - {{ $franchise->name }}
            </h5>
            <div class="flex items-center gap-2">
                <form method="GET" action="{{ route('admin.franchises.payments', $franchise->id) }}" class="flex items-center gap-2">
                    <select name="year" class="form-select scrollbar-hide" onchange="this.form.submit()" style="scrollbar-width: none; -ms-overflow-style: none;">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('admin.franchises.index') }}" class="btn btn-secondary">Back to Franchises</a>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.franchises.update-payments', $franchise->id) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="year" value="{{ $currentYear }}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-5">
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

            <div class="panel">
                <div class="p-5">
                    <h6 class="font-semibold mb-4">Monthly Payment Status for {{ $currentYear }}</h6>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
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
                        
                        @foreach($months as $key => $month)
                        <label class="flex items-center cursor-pointer p-3 border rounded-lg hover:bg-gray-50 transition-colors payment-checkbox">
                            <input type="checkbox" 
                                   name="{{ $key }}" 
                                   class="form-checkbox h-5 w-5 text-primary rounded"
                                   {{ $payment->$key ? 'checked' : '' }}
                                   onchange="updatePaymentCount()">
                            <span class="ml-3 text-sm font-medium {{ $payment->$key ? 'text-success' : 'text-gray-700' }}">
                                {{ $month }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 flex justify-end gap-2">
                        <button type="button" class="btn btn-secondary" onclick="selectAll()">Select All</button>
                        <button type="button" class="btn btn-warning" onclick="deselectAll()">Deselect All</button>
                        <button type="submit" class="btn btn-success">Save Payment Status</button>
                    </div>
                </div>
            </div>
        </form>
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

    <script>
        function updatePaymentCount() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            let checkedCount = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });
            
            document.getElementById('paid-count').textContent = checkedCount;
            document.getElementById('pending-count').textContent = 12 - checkedCount;
            
            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = ((checkedCount / 12) * 100) + '%';
            
            // Update label colors
            checkboxes.forEach(checkbox => {
                const label = checkbox.parentElement;
                const span = label.querySelector('span');
                if (checkbox.checked) {
                    span.classList.remove('text-gray-700');
                    span.classList.add('text-success');
                } else {
                    span.classList.remove('text-success');
                    span.classList.add('text-gray-700');
                }
            });
        }

        function selectAll() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => checkbox.checked = true);
            updatePaymentCount();
        }

        function deselectAll() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            updatePaymentCount();
        }
    </script>
</x-layout.admin>
