<x-layout.admin>
<x-add-button :link="route('listing-categories.create')" />

 <br><br>
<div class="panel">
    <div class="flex items-center justify-between mb-5">
        <h5 class="font-semibold text-lg dark:text-white-light">Listing Categories</h5>
        <div class="flex items-center">
            <form action="" method="get" class="flex items-center">
                <input type="text" name="search" placeholder="search categories" class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                <button class="btn btn-primary px-4 py-2" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <div class="mt-6">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <style>
                .actions-column, .actions-column * { text-align: right !important; }
                .actions-column .flex { justify-content: flex-end !important; }
            </style>
            <table class="table-hover">
                <thead>
                    <tr>
                         <th>Category</th>
                        <th style="text-align: right !important;" class="text-end actions-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                             <td>{{ $category->listing_category }}</td>
                            <td class="text-end actions-column">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('listing-categories.edit', $category->id) }}" class="btn btn-outline-primary shadow-lg transform hover:-translate-y-1 transition-transform duration-200" style="box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08); border-bottom: 3px solid #2563eb;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                            <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('listing-categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                            <td colspan="3" class="text-center">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for adding new category -->
<style>
    /* Modal Center Styling */
    .modal-center {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-height: 100vh !important;
        padding: 0 !important;
    }
    
    .modal-content {
        margin: 0 auto !important;
    }
    
    /* Toast Notification Styling */
    .toast {
        position: relative;
        padding: 1rem;
        border-radius: 0.25rem;
        margin-bottom: 0.75rem;
        width: 300px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
    }
    
    .toast-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
    
    .toast-error {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }
    
    .toast-icon {
        margin-right: 0.75rem;
        font-size: 1.25rem;
    }
    
    .toast-message {
        flex-grow: 1;
    }
    
    .toast-close {
        cursor: pointer;
        font-size: 1.25rem;
        line-height: 1;
        color: inherit;
        opacity: 0.75;
    }
    
    .toast-close:hover {
        opacity: 1;
    }
    
    /* Make sure modals don't leave elements that block clicks */
    .modal-cleanup-fix {
        pointer-events: auto !important;
    }
    
    /* Ensure modal backdrop doesn't block interaction */
    .modal-backdrop-fix {
        pointer-events: none !important;
        opacity: 0 !important;
        display: none !important;
    }
</style>

<!-- Modal fix button -->
<div id="modal-fix-button" style="display:none; position:fixed; bottom:20px; right:20px; z-index:9999;">
    <button onclick="forceFixPage()" class="btn btn-primary btn-sm">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1">
            <path d="M12 8V12L15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5" />
        </svg>
        Fix Page
    </button>
</div>

<script>
    // Global function to force fix the page when modals cause issues
    function forceFixPage() {
        // Remove all modal-related elements
        document.querySelectorAll('.fixed.inset-0.bg-gray-500, .fixed.inset-0.transform').forEach(el => {
            if (el.parentNode) el.parentNode.removeChild(el);
        });
        
        // Reset body styles
        document.body.classList.remove('overflow-y-hidden');
        document.body.style.overflow = 'auto';
        document.body.style.pointerEvents = 'auto';
        
        // Hide the fix button
        document.getElementById('modal-fix-button').style.display = 'none';
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-detect if the page needs fixing after modals close
        setTimeout(function() {
            // Show fix button if overlay is present but modals are hidden
            const checkPageState = function() {
                const overlay = document.querySelector('.fixed.inset-0.bg-gray-500');
                const modalVisible = document.querySelector('.fixed.inset-0.overflow-y-auto[style*="display: block"]');
                
                if (overlay && !modalVisible) {
                    document.getElementById('modal-fix-button').style.display = 'block';
                } else {
                    document.getElementById('modal-fix-button').style.display = 'none';
                }
            };
            
            // Check periodically
            setInterval(checkPageState, 1000);
            
            // Also check after any click
            document.addEventListener('click', function() {
                setTimeout(checkPageState, 500);
            });
        }, 2000);

        // Function to completely fix modal interaction issues
        function fixModalInteraction() {
            // Add a forced timeout to ensure Alpine.js has completed its transitions
            setTimeout(function() {
                // 1. Force remove any lingering backdrop/overlay elements
                const overlays = document.querySelectorAll('.fixed.inset-0.bg-gray-500, .fixed.inset-0.transform');
                overlays.forEach(el => {
                    // Just completely remove the element from DOM
                    if (el.parentNode) {
                        el.parentNode.removeChild(el);
                    }
                });
                
                // 2. Force body to be interactive
                document.body.classList.remove('overflow-y-hidden');
                document.body.style.overflow = 'auto';
                document.body.style.pointerEvents = 'auto';
                
                // 3. Ensure all modal-related classes are removed
                document.querySelectorAll('.fixed.inset-0.overflow-y-auto').forEach(el => {
                    el.classList.remove('modal-center');
                    el.style.pointerEvents = 'auto';
                    
                    // For modals that should be hidden
                    if (window.getComputedStyle(el).display === 'none') {
                        el.style.zIndex = '-1';
                    }
                    
                    const content = el.querySelector('.mb-6.bg-white.rounded-lg');
                    if (content) {
                        content.classList.remove('modal-content');
                    }
                });
                
                // 4. Extra insurance - add a click handler that will remove any remaining modal elements
                if (!window._modalClickHandlerAdded) {
                    document.addEventListener('click', function(e) {
                        const overlays = document.querySelectorAll('.fixed.inset-0.bg-gray-500');
                        if (overlays.length > 0) {
                            overlays.forEach(el => {
                                if (el.parentNode) {
                                    el.parentNode.removeChild(el);
                                }
                            });
                            document.body.classList.remove('overflow-y-hidden');
                        }
                    });
                    window._modalClickHandlerAdded = true;
                }
            }, 350); // Give Alpine.js time to finish transitions
        }
        
        // Add global key handler to force interactivity when Escape is pressed
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                fixModalInteraction();
            }
        });
        
        // Apply the centering class when the modal opens
        document.addEventListener('open-modal', function(event) {
            if (event.detail === 'add-category-modal' || event.detail === 'edit-category-modal') {
                setTimeout(function() {
                    // Target the modal container
                    const modalElement = document.querySelector('.fixed.inset-0.overflow-y-auto');
                    if (modalElement) {
                        modalElement.classList.add('modal-center');
                        
                        // Also ensure the modal content is properly styled
                        const modalContent = modalElement.querySelector('.mb-6.bg-white.rounded-lg');
                        if (modalContent) {
                            modalContent.classList.add('modal-content');
                        }
                    }
                }, 10);
            }
        });
        
        // Clean up properly when the modal closes
        document.addEventListener('close-modal', function(event) {
            fixModalInteraction();
        });
        
        // Handle when modal is closed by clicking outside
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('fixed') && 
                event.target.classList.contains('inset-0') && 
                event.target.classList.contains('transform')) {
                fixModalInteraction();
            }
        }, true);

        // Add a failsafe cleanup mechanism 
        document.querySelectorAll('button[x-on\:click="show = false"]').forEach(button => {
            button.addEventListener('click', function() {
                fixModalInteraction();
            });
        });
        
        // Extra safety - call the fix on any click to the document after a small delay
        let clickTimer;
        document.addEventListener('click', function() {
            clearTimeout(clickTimer);
            clickTimer = setTimeout(function() {
                const overlay = document.querySelector('.fixed.inset-0.bg-gray-500');
                if (overlay && window.getComputedStyle(overlay).opacity > 0) {
                    fixModalInteraction();
                }
            }, 500);
        });
    });
</script>

<x-modal name="add-category-modal" :show="false" maxWidth="md">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4 text-center">Add New Listing Category</h2>
        
        <form id="addCategoryForm" method="POST" action="{{ route('listing-categories.store') }}">
            @csrf
            <div class="mb-4">
                <label for="listing_category" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="listing_category" id="listing_category" class="form-input w-full rounded-md" required>
                <span class="text-danger error-text listing_category_error mt-1"></span>
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <button type="button" class="btn btn-outline-danger mr-2" x-on:click="show = false">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</x-modal>

<!-- Toast Notification Container -->
<div id="toast-container" class="fixed top-4 right-4 z-50"></div>

<!-- Edit Category Modal -->
<x-modal name="edit-category-modal" :show="false" maxWidth="md">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4 text-center">Edit Listing Category</h2>
        
        <!-- Success Message Container -->
        <div id="edit-success-message" class="alert alert-success mb-4" style="display: none;">
            <span id="success-message-text"></span>
        </div>
        
        <form id="editCategoryForm" method="POST" action="">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_category_id" name="category_id" value="">
            
            <div class="mb-4">
                <label for="edit_listing_category" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="listing_category" id="edit_listing_category" class="form-input w-full rounded-md" required>
                <span class="text-danger error-text edit_listing_category_error mt-1"></span>
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <button type="button" class="btn btn-outline-danger mr-2" x-on:click="show = false">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</x-modal>

<!-- Include Scripts -->
<script>
    // Function to show toast notifications
    function showNotification(type, message) {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        
        // Set toast classes based on type
        const baseClasses = 'p-4 mb-3 rounded-md shadow-md transform transition-all duration-300 translate-x-full';
        const typeClasses = type === 'success' 
            ? 'bg-green-500 text-white' 
            : 'bg-red-500 text-white';
        
        toast.className = `${baseClasses} ${typeClasses}`;
        toast.innerHTML = `
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    ${type === 'success' 
                        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' 
                        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'}
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        // Add toast to container
        container.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 10);
        
        // Remove after delay
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                container.removeChild(toast);
            }, 300);
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Add category form handling
        const addCategoryForm = document.getElementById('addCategoryForm');
        
        if (addCategoryForm) {
            addCategoryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 0) {
                        // Clear previous errors
                        document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
                        
                        // Display validation errors
                        for(const [field, errors] of Object.entries(data.error)) {
                            const errorElement = document.querySelector('.' + field + '_error');
                            if(errorElement) {
                                errorElement.textContent = errors[0];
                                // Show error notification
                                showNotification('error', errors[0]);
                            }
                        }
                    } else if(data.status === 1) {
                        // Success - close modal and show notification
                        document.dispatchEvent(new CustomEvent('close-modal', { detail: 'add-category-modal' }));
                        
                        // Clear form
                        addCategoryForm.reset();
                        
                        // Show success notification
                        showNotification('success', data.message);
                        
                        // Refresh categories list without full page reload
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }
        
        // Edit category functionality
        const editButtons = document.querySelectorAll('.edit-category');
        const editCategoryForm = document.getElementById('editCategoryForm');
        const editCategoryId = document.getElementById('edit_category_id');
        const editListingCategory = document.getElementById('edit_listing_category');
        const successMessage = document.getElementById('edit-success-message');
        const successMessageText = document.getElementById('success-message-text');
        
        // Set up the edit buttons to populate the modal
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');
                
                // Set form values
                editCategoryId.value = categoryId;
                editListingCategory.value = categoryName;
                editCategoryForm.action = `{{ url('admin/listing-categories') }}/${categoryId}`;
                
                // Hide any previous success message
                successMessage.style.display = 'none';
                
                // Clear any previous errors
                document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
            });
        });
        
        // Handle form submission
        if (editCategoryForm) {
            editCategoryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 0) {
                        // Clear previous errors
                        document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
                        
                        // Display validation errors
                        for(const [field, errors] of Object.entries(data.error)) {
                            const errorElement = document.querySelector('.edit_' + field + '_error');
                            if(errorElement) {
                                errorElement.textContent = errors[0];
                            }
                        }
                    } else if(data.status === 1) {
                        // Show success message inside the modal
                        successMessageText.textContent = data.message;
                        successMessage.style.display = 'block';
                        
                        // Refresh categories list after a short delay
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }
    });
</script>
</x-layout.admin>
