<x-layout.admin>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('pages.index') }}" class="text-primary hover:underline">Pages</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>
    <div class="pt-5">        
        <form class="space-y-5" action="{{ route('pages.update', ['page' => $page->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Page</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">               
                    <x-text-input name="title" value="{{ old('title', $page->title) }}" :label="__('Page title')" :require="true" :messages="$errors->get('title')"/>              
                        <div>
                            <label>Layouts</label>
                            <select class="form-input" name="layout"   id="layout">
                                <option value="" selected>select an option</option>
                                <option value="about_us" {{$page->layout === 'about_us' ? 'selected' : ""}} >About us</option>
                                <option value="contact_us" {{$page->layout === 'contact_us' ? 'selected' : ""}}>Contact us</option>
                                <option value="success_stories" {{$page->layout === 'success_stories' ? 'selected' : ""}}>Success Stories</option>
                                <option value="terms_and_conditions" {{$page->layout === 'terms_and_conditions' ? 'selected' : ""}}>Terms and Conditions</option>
                                <option value="privacy_policy" {{$page->layout === 'privacy_policy' ? 'selected' : ""}}>Privacy Policy</option>
                                <option value="disclaimer" {{$page->layout === 'disclaimer' ? 'selected' : ""}}>Disclaimer</option>
                            </select> 
                            <x-input-error :messages="$errors->get('layout')" class="mt-2" /> 
                        </div> 
                </div>
                <textarea name="description" id="description" class="description form-control" cols="45" rows="10">{{ old('description', $page->description) }}</textarea>

                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('pages.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>
            </div>
        </form> 
    </div>
</div>
</x-layout.admin>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            placeholder: "description...",
            tabsize: 2,
            height: 300,
            toolbar: [
                // Font and Style
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],

                // Paragraph alignment and list options
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                
                // Insert Options
                ['insert', ['link', 'picture', 'video', 'table', 'hr']],

                // Miscellaneous options
                ['view', ['fullscreen', 'codeview', 'help']],
                
                // Headings (h1 to h6)
                ['style', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']],
                
                // Alignment options
                ['align', ['alignleft', 'aligncenter', 'alignright', 'alignjustify']],
                
                // Other advanced options
                ['fontname', ['fontname']],   // Custom font options
                ['lineheight', ['lineheight']], // Line height options
                ['table', ['table']],         // Table options (Insert table, etc.)
                ['background', ['backcolor']] // Background color options
            ]
        });
    });
</script>
