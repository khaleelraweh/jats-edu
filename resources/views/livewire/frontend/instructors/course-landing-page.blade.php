<div>
    <header class="d-flex justify-content-end">
        <div class="completed-section-badge">
            @if ($databaseDataValid || ($formSubmitted && !$errors->any()))
                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
            @endif
        </div>
    </header>
    <p class="h6 py-3 text-muted">{{ __('transf.Course Landing Page Description') }} </p>

    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('transf.Course Landing Page') }}
                </h3>
            </div>

        </div>

        {{-- body part  --}}
        <div class="card-body">

            {{-- erorrs show is exists --}}
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}


            <form wire:submit.prevent="updateCourse" id="my_form_id" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- links of tabs --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="course_content-tab" data-bs-toggle="tab"
                            data-bs-target="#course_content" type="button" role="tab"
                            aria-controls="course_content" aria-selected="true">{{ __('transf.course_content_tab') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="course_info-tab" data-bs-toggle="tab" data-bs-target="#course_info"
                            type="button" role="tab" aria-controls="course_info"
                            aria-selected="true">{{ __('transf.course_info_tab') }}
                        </button>
                    </li>


                </ul>

                {{-- contents of links tabs  --}}
                <div class="tab-content" id="myTabContent">


                    {{-- Course info --}}
                    <div class="tab-pane fade show active" id="course_content" role="tabpanel"
                        aria-labelledby="course_content-tab">

                        <div class="row">
                            {{-- البيانات الاساسية --}}
                            <div class="col-md-12 col-sm-12 ">
                                {{-- course name field --}}
                                <div class="row ">
                                    <div class="col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="title">
                                                {{ __('transf.course_title') }}
                                                <span style="color: #cc1818;">*</span>
                                            </label>

                                            <div class="input-group">
                                                <input type="text" name="title" id="title" wire:model="title"
                                                    value="{{ old('title', $course->title) }}" class="form-control"
                                                    placeholder="{{ __('transf.Insert your course title.') }}"
                                                    style="height: 45px;">
                                                <span class="input-group-text">{{ 60 - strlen($title) }}</span>
                                            </div>
                                            <span class="text-muted d-inline-block mt-1">
                                                <small>
                                                    {{ __('transf.Insert your course title tip.') }}
                                                </small>
                                            </span>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- course subtitle field --}}
                                <div class="row ">
                                    <div class="col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="subtitle">
                                                {{ __('transf.Course subtitle') }}
                                                <span style="color: #cc1818;">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="subtitle" id="subtitle"
                                                    wire:model="subtitle"
                                                    value="{{ old('subtitle', $course->subtitle) }}"
                                                    class="form-control"
                                                    placeholder="{{ __('transf.Insert your course subtitle.') }}"
                                                    style="height: 45px;">
                                                <span class="input-group-text">{{ 120 - strlen($subtitle) }}</span>
                                            </div>


                                            <span class="text-muted d-inline-block mt-1">
                                                <small>
                                                    {{ __('transf.Course subtitle tip.') }}
                                                </small>
                                            </span>
                                            @error('subtitle')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{--  description field --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 pt-4">
                                        <label for="description">
                                            {{ __('transf.Course description') }}
                                            <span style="color: #cc1818;">*</span>
                                        </label>
                                        <textarea name="description" id="tinymceExample" rows="10" class="form-control" wire:model.defer="description"
                                            placeholder="{{ __('transf.Insert your course description.') }}"></textarea>
                                        @error('tinymceExample')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 col-sm-12 ">

                                <div class="row">
                                    <div class="col-12 pt-4">
                                        <label for="images">
                                            {{ __('transf.Course Image') }}
                                            <span style="color: #cc1818;">*</span>
                                        </label>

                                        <img src="{{ $currentImage }}" style="display: block;width:100%;height:200px;"
                                            alt="{{ $course->title }}">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-12 pt-5">
                                <p>
                                    {{ __('transf.Course Image tip.') }}
                                </p>
                                <input type="file" wire:model="images" id="images" class="form-control"
                                    multiple style="height: 39px !important;">

                            </div>


                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        {{-- video promo   --}}
                        <div class="row ">
                            <div class="col-sm-12 col-md-6 pt-4">
                                <label for="video_promo">{{ __('transf.Promotional video') }}</label>
                                <input type="text" name="video_promo" wire:model.defer="video_promo"
                                    id="video_promo" value="{{ old('video_promo', $course->video_promo) }}"
                                    class="form-control"
                                    placeholder="{{ __('transf.Insert the link to your YouTube promotional video.') }}">
                                @error('video_promo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 col-md-6 pt-4">
                                {{ __('transf.Promotional video tip.') }}
                            </div>

                        </div>

                        {{-- video description   --}}
                        <div class="row ">
                            <div class="col-sm-12 col-md-6 pt-4">
                                <label for="video_description">{{ __('transf.Descriptional video') }}</label>
                                <input type="text" name="video_description" wire:model.defer="video_description"
                                    id="video_description"
                                    value="{{ old('video_description', $course->video_description) }}"
                                    class="form-control"
                                    placeholder="{{ __('transf.Insert the link to your YouTube Descriptional video.') }}">
                                @error('video_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 col-md-6 pt-4">
                                {{ __('transf.Descriptional video tip.') }}
                            </div>

                        </div>

                    </div>

                    {{-- Course basic info --}}
                    <div class="tab-pane fade" id="course_info" role="tabpanel" aria-labelledby="course_info-tab">



                        <div class="row">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="language">{{ __('transf.Course Language') }}</label>
                                <select name="language" wire:model.defer="language" class="form-control">
                                    <option value="1"
                                        {{ old($language, $course->language) == '1' ? 'selected' : null }}>
                                        {{ __('transf.lang_ar') }}
                                    </option>
                                    <option value="2"
                                        {{ old($language, $course->language) == '2' ? 'selected' : null }}>
                                        {{ __('transf.lang_en') }}
                                    </option>

                                </select>
                                @error('language')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="skill_level">{{ __('transf.Course Level') }}</label>
                                <select name="skill_level" wire:model.defer="skill_level" class="form-control">
                                    <option value=""> -- {{ __('transf.Select Level') }} --
                                    <option value="1"
                                        {{ old($skill_level, $course->skill_level) == '1' ? 'selected' : null }}>
                                        {{ __('transf.Beginner Level') }}
                                    </option>
                                    <option value="2"
                                        {{ old($skill_level, $course->skill_level) == '2' ? 'selected' : null }}>
                                        {{ __('transf.Intermediate Level') }}
                                    </option>
                                    <option value="3"
                                        {{ old($skill_level, $course->skill_level) == '3' ? 'selected' : null }}>
                                        {{ __('transf.Advance Level') }}
                                    </option>
                                    <option value="4"
                                        {{ old($skill_level, $course->skill_level) == '4' ? 'selected' : null }}>
                                        {{ __('transf.All Levels') }}
                                    </option>
                                </select>
                                @error('skill_level')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <div class="row ">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="course_type">{{ __('transf.Course type') }}</label>
                                <select name="course_type" id="course_type" class="form-control"
                                    wire:model.defer="course_type">
                                    <option value="1"
                                        {{ old($course_type, $course->course_type) == '1' ? 'selected' : null }}>
                                        {{ __('transf.Course presence') }}
                                    </option>
                                    <option value="2"
                                        {{ old($course_type, $course->course_type) == '2' ? 'selected' : null }}>
                                        {{ __('transf.Course enrolled') }}
                                    </option>
                                </select>
                                @error('course_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="category_id"> {{ __('transf.course_category_title') }}</label>
                                <select name="course_category_id" wire:model.defer="course_category_id"
                                    class="form-control" style="height: 45px;">
                                    <option value=""> -- {{ __('transf.Select Category') }} --
                                    </option>
                                    @forelse ($course_categories as $course_category)
                                        <option value="{{ $course_category->id }}"
                                            {{ old('course_category_id', $course->course_category_id) == $course_category->id ? 'selected' : null }}>
                                            {{ $course_category->title }} </option>
                                    @empty
                                    @endforelse
                                </select>


                            </div>


                        </div>









                        {{-- course   certificate --}}
                        <div class="row ">

                            <div class="col-sm-12 col-md-6 pt-3">

                                <div class="form-group">
                                    <label for="certificate">{{ __('transf.certificate') }}</label>
                                    <input style="width: 100%" type="checkbox" wire:model.defer="certificate"
                                        id="certificate" class="form-check-input">
                                    <span class="text-muted d-inline-block mt-1">
                                        <small>{{ __('transf.certificate_tip') }}</small>
                                    </span>
                                    @error('certificate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div id="deadline-field" style="display: none" wire:ignore class="col-md-6  pt-3">
                                <div class="form-group">
                                    <label for="deadline">{{ __('transf.deadline_of_the_course') }}</label>
                                    {{-- <input type="text" name="deadline" wire:model.defer="deadline"
                                        value="{{ old('deadline', \Carbon\Carbon::parse($course->deadline)->translatedFormat('Y-m-d h:i A')) }}"
                                        class="form-control flatpickr_deadLine"> --}}

                                    <input type="text" name="deadline" class="form-control flatpickr_deadline"
                                        wire:model.defer="deadline" readonly>


                                    @error('deadline')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>



                    </div>




                    <div class="form-group pt-4">
                        <button type="submit" name="submit" class="btn btn-primary">
                            {{ __('transf.Update Data') }}
                        </button>
                    </div>


                </div>

            </form>
        </div>






    </div>
</div>




<script>
    document.addEventListener('livewire:load', function() {
        initTinyMCE();

        Livewire.on('initializeTinyMCE', () => {
            initTinyMCE();
        });

        // Listen for the form submission to set TinyMCE content to Livewire
        document.getElementById('my_form_id').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Set the content of TinyMCE editor to Livewire property 'description'
            if (tinymce.get('tinymceExample')) {
                @this.set('description', tinymce.get('tinymceExample').getContent());
            }

            // Now submit the form using Livewire
            @this.call('updateCourse'); // This will trigger the Livewire method to update the course
        });
    });

    document.addEventListener('livewire:update', function() {
        initTinyMCE();
    });

    function initTinyMCE() {
        if (tinymce.get('tinymceExample')) {
            tinymce.get('tinymceExample').remove();
        }

        tinymce.init({
            // selector: '#tinymceExample',
            selector: 'textarea',
            language: '{{ app()->getLocale() }}',
            min_height: 350,
            default_text_color: 'red',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table  directionality emoticons template paste ",
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: [],

            // Enable image title and upload functionality
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        // Call the callback and populate the Title field with the file name
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },

            // Add alignment options for images in the toolbar
            image_advtab: true,
            // toolbar2: 'alignleft aligncenter alignright | imageoptions',

            // Add alignment to the context menu
            contextmenu: 'image align | link',

            // Custom content style for image alignment
            content_style: `
                body { font-family:Helvetica,Arial,sans-serif; font-size:14px }
                img { display: block; margin-left: auto; margin-right: auto; }
            `,

            // Customize the image dialog to include alignment
            setup: function(editor) {
                editor.ui.registry.addContextToolbar('imagealign', {
                    predicate: function(node) {
                        return node.nodeName.toLowerCase() === 'img';
                    },
                    items: 'alignleft aligncenter alignright',
                    position: 'node',
                    scope: 'node'
                });
            }

        });
    }
</script>

@push('scripts')
    <script>
        var tinymceLanguage = '{{ app()->getLocale() }}'; // Get the current locale from Laravel config
        var flatPickrLanguage = '{{ app()->getLocale() }}';
    </script>

    <script>
        document.addEventListener('livewire:load', function() {
            flatpickr('.flatpickr_deadline', {
                enableTime: true,
                dateFormat: "Y/m/d h:i K",
                defaultDate: '{{ $deadline ?? now()->format('Y/m/d h:i A') }}',
                // minDate: "today",
                locale: typeof flatPickrLanguage !== 'undefined' ? flatPickrLanguage : 'en',

                onChange: function(deadline, dateStr, instance) {
                    @this.set('deadline',
                        dateStr); // Update Livewire component's deadline property
                }
            });
        });
    </script>
@endpush
