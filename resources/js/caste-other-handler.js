/**
 * Caste and SubCaste "Other" Option Handler
 * Provides reusable functionality for showing/hiding custom text inputs
 * when "Other" is selected in caste or subcaste dropdowns
 */

class CasteOtherHandler {
    constructor(config = {}) {
        this.casteSelectId = config.casteSelectId || 'caste';
        this.subCasteSelectId = config.subCasteSelectId || 'sub_caste';
        this.customCasteInputId = config.customCasteInputId || 'custom_caste';
        this.customSubCasteInputId = config.customSubCasteInputId || 'custom_sub_caste';
        this.customCasteContainerId = config.customCasteContainerId || 'custom_caste_container';
        this.customSubCasteContainerId = config.customSubCasteContainerId || 'custom_sub_caste_container';
        this.otherOptionText = config.otherOptionText || 'Other';
        this.apiBaseUrl = config.apiBaseUrl || '/castes';
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.checkInitialState();
    }
    
    bindEvents() {
        const casteSelect = document.getElementById(this.casteSelectId);
        const subCasteSelect = document.getElementById(this.subCasteSelectId);
        
        if (casteSelect) {
            casteSelect.addEventListener('change', () => {
                this.handleCasteChange();
            });
        }
        
        if (subCasteSelect) {
            subCasteSelect.addEventListener('change', () => {
                this.handleSubCasteChange();
            });
        }
    }
    
    handleCasteChange() {
        const casteSelect = document.getElementById(this.casteSelectId);
        const subCasteSelect = document.getElementById(this.subCasteSelectId);
        
        if (!casteSelect) return;
        
        const selectedCasteId = casteSelect.value;
        const selectedOption = casteSelect.options[casteSelect.selectedIndex];
        const selectedCasteName = selectedOption ? selectedOption.text : '';
        
        // Show/hide custom caste input
        this.toggleCustomCasteInput(selectedCasteName === this.otherOptionText);
        
        // Load subcastes and reset subcaste selection
        if (selectedCasteId && subCasteSelect) {
            this.loadSubcastes(selectedCasteId);
        }
        
        // Hide custom subcaste input when caste changes
        this.toggleCustomSubCasteInput(false);
    }
    
    handleSubCasteChange() {
        const subCasteSelect = document.getElementById(this.subCasteSelectId);
        
        if (!subCasteSelect) return;
        
        const selectedOption = subCasteSelect.options[subCasteSelect.selectedIndex];
        const selectedSubCasteName = selectedOption ? selectedOption.text : '';
        
        // Show/hide custom subcaste input
        this.toggleCustomSubCasteInput(selectedSubCasteName === this.otherOptionText);
    }
    
    toggleCustomCasteInput(show) {
        const container = document.getElementById(this.customCasteContainerId);
        const input = document.getElementById(this.customCasteInputId);
        
        if (container) {
            container.style.display = show ? 'block' : 'none';
        }
        
        if (input) {
            input.required = show;
            if (!show) {
                input.value = '';
            }
        }
    }
    
    toggleCustomSubCasteInput(show) {
        const container = document.getElementById(this.customSubCasteContainerId);
        const input = document.getElementById(this.customSubCasteInputId);
        
        if (container) {
            container.style.display = show ? 'block' : 'none';
        }
        
        if (input) {
            input.required = show;
            if (!show) {
                input.value = '';
            }
        }
    }
    
    async loadSubcastes(casteId, selectedSubcaste = null) {
        const subCasteSelect = document.getElementById(this.subCasteSelectId);
        
        if (!subCasteSelect) {
            console.error('SubCaste select element not found');
            return;
        }
        
        // Clear existing options
        subCasteSelect.innerHTML = '<option value="" disabled selected>Select Subcaste</option>';
        
        if (!casteId) {
            return;
        }
        
        try {
            const response = await fetch(`${this.apiBaseUrl}/${casteId}/subcastes`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const data = await response.json();
            
            data.forEach(subcaste => {
                const option = document.createElement('option');
                option.value = subcaste.id;
                option.textContent = subcaste.name;
                
                if (selectedSubcaste && selectedSubcaste == subcaste.id) {
                    option.selected = true;
                }
                
                subCasteSelect.appendChild(option);
            });
            
            // Check if the selected subcaste is "Other" after loading
            if (selectedSubcaste) {
                const selectedOption = subCasteSelect.options[subCasteSelect.selectedIndex];
                if (selectedOption && selectedOption.text === this.otherOptionText) {
                    this.toggleCustomSubCasteInput(true);
                }
            }
            
        } catch (error) {
            console.error('Error loading subcastes:', error);
        }
    }
    
    checkInitialState() {
        const casteSelect = document.getElementById(this.casteSelectId);
        const subCasteSelect = document.getElementById(this.subCasteSelectId);
        
        // Check initial caste state
        if (casteSelect && casteSelect.value) {
            const selectedOption = casteSelect.options[casteSelect.selectedIndex];
            if (selectedOption && selectedOption.text === this.otherOptionText) {
                this.toggleCustomCasteInput(true);
            }
        }
        
        // Check initial subcaste state
        if (subCasteSelect && subCasteSelect.value) {
            const selectedOption = subCasteSelect.options[subCasteSelect.selectedIndex];
            if (selectedOption && selectedOption.text === this.otherOptionText) {
                this.toggleCustomSubCasteInput(true);
            }
        }
    }
    
    // Public method to set values programmatically
    setValues(casteId, subCasteId, customCaste = '', customSubCaste = '') {
        const casteSelect = document.getElementById(this.casteSelectId);
        const subCasteSelect = document.getElementById(this.subCasteSelectId);
        const customCasteInput = document.getElementById(this.customCasteInputId);
        const customSubCasteInput = document.getElementById(this.customSubCasteInputId);
        
        if (casteSelect && casteId) {
            casteSelect.value = casteId;
            this.handleCasteChange();
            
            if (customCaste && customCasteInput) {
                customCasteInput.value = customCaste;
            }
        }
        
        if (subCasteId) {
            // Wait for subcastes to load before setting subcaste
            setTimeout(() => {
                if (subCasteSelect) {
                    subCasteSelect.value = subCasteId;
                    this.handleSubCasteChange();
                    
                    if (customSubCaste && customSubCasteInput) {
                        customSubCasteInput.value = customSubCaste;
                    }
                }
            }, 500);
        }
    }
}

// Make it globally available
window.CasteOtherHandler = CasteOtherHandler;
