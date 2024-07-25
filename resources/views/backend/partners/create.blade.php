@extends('layouts.admin')
@section('style')
    <style>
        .note-editor.note-airframe,
        .note-editor.note-frame {
            margin-bottom: 0;
        }

        #offer_ends_group .picker--opened .picker__holder {
            transform: translateY(-342px) perspective(600px) rotateX(0);
        }
    </style>
@endsection

@section('content')

    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_new_partner') }}
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a>
                        @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')
                            <i class="fa fa-solid fa-chevron-left chevron"></i>
                        @else
                            <i class="fa fa-solid fa-chevron-right chevron"></i>
                        @endif
                    </li>
                    <li>
                        <a href="{{ route('admin.partners.index') }}">
                            {{ __('panel.show_partners') }}
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- body part  --}}
        <div class="card-body">

            {{-- erorrs show is exists --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- enctype used cause we will save images  --}}
            <form id="my_form_id" action="{{ route('admin.partners.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- links of tabs --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content" aria-selected="true">
                            {{ __('panel.content_tab') }}
                        </button>
                    </li>


                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="published-tab" data-bs-toggle="tab" data-bs-target="#published"
                            type="button" role="tab" aria-controls="published"
                            aria-selected="false">{{ __('panel.published_tab') }}
                        </button>
                    </li>

                </ul>
                {{-- contents of links tabs  --}}
                <div class="tab-content" id="myTabContent">

                    {{-- Content Tab --}}
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content">

                        <div class="row">
                            {{-- البيانات الاساسية --}}
                            <div class="col-md-7 col-sm-12 ">

                                {{-- partner name field --}}
                                <div class="row">
                                    <div class="col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __('transf.partner_name') }}
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="name" id="name"
                                                    value="{{ old('name') }}" class="form-control" maxlength="60">
                                                <span class="input-group-text" id="charCount">60</span>
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- partner description field --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 pt-3">
                                        <label for="description">
                                            {{ __('panel.description') }}
                                        </label>
                                        <textarea name="description" rows="10" class="form-control summernote">
                                            {!! old('description') !!}
                                        </textarea>
                                        @error('partner_category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- مرفق الصور  --}}
                            <div class="col-md-5  col-sm-12 ">

                                <div class="row ">
                                    <div class="col-sm-12 col-md-12 pt-3">
                                        <label for="images">
                                            {{ __('panel.image') }}
                                            /
                                            {{ __('panel.images') }}
                                        </label>
                                        <div class="file-loading">
                                            <input type="file" name="images[]" id="partner_images"
                                                class="file-input-overview" multiple="multiple">
                                            @error('images')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Published Tab --}}
                    <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">

                        {{-- publish_start publish time field --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <div class="form-group">
                                    <label for="published_on">{{ __('panel.published_date') }}</label>
                                    <input type="text" id="published_on" name="published_on"
                                        value="{{ old('published_on', now()->format('Y-m-d')) }}" class="form-control">
                                    @error('published_on')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <div class="form-group">
                                    <label for="published_on_time">{{ __('panel.published_time') }}</label>
                                    <input type="text" id="published_on_time" name="published_on_time"
                                        value="{{ old('published_on_time', now()->format('h:m A')) }}"
                                        class="form-control">
                                    @error('published_on_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- status and featured field --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <label for="status">{{ __('panel.status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>
                                        {{ __('panel.status_inactive') }}
                                    </option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>
                                        {{ __('panel.status_active') }}
                                    </option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-group pt-3">
                        <button type="submit" name="submit" class="btn btn-primary">
                            {{ __('panel.save_data') }}</button>
                    </div>

                </div>
            </form>
        </div>

    </div>

@endsection

@section('script')
    {{-- Call select2 plugin --}}
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>

    {{-- name counter  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const charCount = document.getElementById('charCount');
            const maxChars = 60;

            // Function to update the character count
            function updateCharCount() {
                const remainingChars = maxChars - nameInput.value.length;
                charCount.textContent = remainingChars;
            }

            // Initialize the character count on page load
            updateCharCount();

            // Update the character count on input
            nameInput.addEventListener('input', updateCharCount);
        });
    </script>

    {{-- subname counter  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subnameInput = document.getElementById('subname');
            const charCountSubname = document.getElementById('charCountSubname');
            const maxChars = 120;

            // Function to update the character count
            function updateCharCountSucharCountSubname() {
                const remainingChars = maxChars - subnameInput.value.length;
                charCountSubname.textContent = remainingChars;
            }

            // Initialize the character count on page load
            updateCharCountSucharCountSubname();

            // Update the character count on input
            subnameInput.addEventListener('input', updateCharCountSucharCountSubname);
        });
    </script>


    <script>
        $(function() {

            $("#partner_images").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });


            $('#published_on').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            var publishedOn = $('#published_on').pickadate(
                'picker'); // set startdate in the picker to the start date in the #start_date elemet

            // when change date 
            $('#published_on').change(function() {
                selected_ci_date = "";
                selected_ci_date = $('#published_on').val();
                if (selected_ci_date != null) {
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate() + 1);
                    enddate.set('min', min_codate);
                }
            });

            $('#published_on_time').pickatime({
                clear: ''
            });

            // start deadline 
            $('#deadline').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            var publishedOn = $('#deadline').pickadate(
                'picker'); // set startdate in the picker to the start date in the #start_date elemet

            // when change date 
            $('#deadline').change(function() {
                selected_ci_date = "";
                selected_ci_date = $('#deadline').val();
                if (selected_ci_date != null) {
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate() + 1);
                    enddate.set('min', min_codate);
                }

            });
            // end deadline 

            // ======= start pickadate codeing ===========
            $('#publish_date').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            $('#offer_ends').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });


            $('.summernote').summernote({
                tabSize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to initialize character counter for a specific input field
            function initializeCharCounter($input) {
                var $counter = $input.parent().find('.input-group-text');

                // Update character count on input
                $input.on('input', function() {
                    var remainingChars = 160 - $(this).val().length;
                    $counter.text(remainingChars);
                });

                // Trigger input event to update counter initially
                $input.trigger('input');
            }

            // Submit event handler for the form
            $('#my_form_id').on('submit', function(event) {
                // Flag to track whether there are empty fields
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('input.partner_objective').each(function() {
                    if ($(this).val() === '') {
                        isEmpty = true;
                        return false; // Exit the loop if any field is empty
                    }
                });

                // If any field is empty, prevent the form submission
                if (isEmpty) {
                    alert('{{ __('panel.msg_one_or_more_topic_field_empty') }}.');
                    event.preventDefault(); // Prevent form submission
                }
            });

            // Add row functionality remains unchanged
            $(document).on('click', '.btn_add', function() {
                let trCount = $('#partner_objectives_details').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#partner_objectives_details').find(
                        'tr.cloning_row:last')
                    .attr('id')) + 1 : 0;
                let isValid = true;

                // Check if any of the existing fields are empty
                $('#partner_objectives_details').find('input.partner_objective').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        return false; // Exit the loop if any field is empty
                    }
                });

                if (!isValid) {
                    alert('{{ __('panel.msg_please_fill_in_all_topic_fields_before_adding_new') }}');
                    return false; // Prevent adding a new row if existing fields are empty
                }

                // Add new row
                var newRow = $('<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td><span>{{ __('panel.partner_objective') }} (' + numberIncr + ')</span></td>' +
                    '<td>' +
                    '<div class="input-group">' +
                    '<input type="text" name="partner_objective[' + numberIncr +
                    ']" class="partner_objective form-control" maxlength="160">' +
                    '<span class="input-group-text">160</span>' +
                    '</div>' +
                    '</td>' +
                    '</tr>');
                $('#partner_objectives_details tbody').append(newRow);

                // Initialize character counter for the new row
                initializeCharCounter(newRow.find('input.partner_objective'));
            });

            // Initialize character counters for existing rows
            $('#partner_objectives_details tbody').find('input.partner_objective').each(function() {
                initializeCharCounter($(this));
            });

            // Remove row when delete button is clicked
            $(document).on('click', '.delegated-btn', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to initialize character counter for a specific input field
            function initializeCharCounter($input) {
                var $counter = $input.parent().find('.input-group-text');

                // Update character count on input
                $input.on('input', function() {
                    var remainingChars = 160 - $(this).val().length;
                    $counter.text(remainingChars);
                });

                // Trigger input event to update counter initially
                $input.trigger('input');
            }

            // Submit event handler for the form
            $('#my_form_id').on('submit', function(event) {
                // Flag to track whether there are empty fields
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('input.partner_requirement').each(function() {
                    if ($(this).val() === '') {
                        isEmpty = true;
                        return false; // Exit the loop if any field is empty
                    }
                });

                // If any field is empty, prevent the form submission
                if (isEmpty) {
                    alert('{{ __('panel.msg_one_or_more_requirement_field_empty') }}.');
                    event.preventDefault(); // Prevent form submission
                }
            });

            // Add row functionality remains unchanged
            $(document).on('click', '.btn_add_requirement', function() {
                let trCount = $('#partner_requirements_details').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#partner_requirements_details').find(
                        'tr.cloning_row:last')
                    .attr('id')) + 1 : 0;
                let isValid = true;

                // Check if any of the existing fields are empty
                $('#partner_requirements_details').find('input.partner_requirement').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        return false; // Exit the loop if any field is empty
                    }
                });

                if (!isValid) {
                    alert(
                        '{{ __('panel.msg_please_fill_in_all_requirement_fields_before_adding_new') }}'
                    );
                    return false; // Prevent adding a new row if existing fields are empty
                }

                // Add new row
                var newRow = $('<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td><span>{{ __('panel.partner_requirement') }} (' + numberIncr +
                    ')</span></td>' +
                    '<td>' +
                    '<div class="input-group">' +
                    '<input type="text" name="partner_requirement[' + numberIncr +
                    ']" class="partner_requirement form-control" maxlength="160">' +
                    '<span class="input-group-text">160</span>' +
                    '</div>' +
                    '</td>' +
                    '</tr>');
                $('#partner_requirements_details tbody').append(newRow);

                // Initialize character counter for the new row
                initializeCharCounter(newRow.find('input.partner_requirement'));
            });

            // Initialize character counters for existing rows
            $('#partner_requirements_details tbody').find('input.partner_requirement').each(function() {
                initializeCharCounter($(this));
            });

            // Remove row when delete button is clicked
            $(document).on('click', '.delegated-btn', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
