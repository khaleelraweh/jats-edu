<li class="nav-item" role="presentation">
    <button class="nav-link" id="course_requirements-tab" data-bs-toggle="tab" data-bs-target="#course_requirements"
        type="button" role="tab" aria-controls="course_requirements"
        aria-selected="true">{{ __('panel.course_requirements_tab') }}
    </button>
</li>







{{-- course requirement  --}}
<div class="tab-pane fade" id="course_requirements" role="tabpanel" aria-labelledby="course_requirements-tab">


    <div class="table-responsive">
        <table class="table" id="course_details">
            <thead>
                <tr class="pt-4">
                    <th width="30px">Act</th>
                    <th width="146px">Type</th>
                    <th>{{ __('panel.txt_what_is_course_requirements') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->topics as $item)
                    <?php
                    $loopIndex = $loop->index;
                    ?>
                    @foreach (config('locales.languages') as $key => $val)
                        <tr class="cloning_row" id="{{ $loopIndex }}">
                            <td style="width: 30px !important;">
                                @if ($loopIndex == 0)
                                    {{ '#' }}
                                @else
                                    <button type="button" class="btn btn-danger btn-sm delegated-btn"><i
                                            class="fa fa-minus"></i></button>
                                @endif
                            </td>
                            <td>{{ __('panel.topic_in_' . $key) }} ({{ $loopIndex }})</td>
                            <td>
                                <input type="text"
                                    name="course_requirement[{{ $loopIndex }}][{{ $key }}]"
                                    id="course_requirement"
                                    value="{{ old('course_requirement' . $key, $item->getTranslation('course_requirement', $key)) }}"
                                    class="course_requirement form-control">
                                @error('course_requirement[{{ $loopIndex }}]' . $key)
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3" class="text-end">
                        <button type="button"
                            class="btn_add_requirement btn btn-primary">{{ __('panel.btn_add_requirement_another_topic') }}</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>














<script>
    // check if topic field is not empty before sending form 
    $(document).ready(function() {
        // Submit event handler for the form
        $('#your_form_id').on('submit', function(event) {
            // Flag to track whether there are empty fields
            let isEmpty = false;

            // Loop through each input field and check if it's empty
            $('input.course_requirement').each(function() {
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

        // Click event handler for adding new rows
        $(document).on('click', '.btn_add_requirement', function() {
            let trCount = $('#course_details').find('tr.cloning_row:last').length;
            let numberIncr = trCount > 0 ? parseInt($('#course_details').find('tr.cloning_row:last')
                .attr('id')) + 1 : 0;

            // Create a flag to check if any field is empty
            let isEmpty = false;

            // Loop through each input field and check if it's empty
            $('#course_details').find('input.course_requirement').each(function() {
                if ($(this).val() === '') {
                    isEmpty = true;
                    return false; // Exit the loop if any field is empty
                }
            });

            // If any field is empty, display an alert
            if (isEmpty) {
                alert(
                    '{{ __('panel.msg_please_fill_in_all_fields_before_adding_another_row') }}.');
                return false; // Prevent the form from submitting
            }

            <?php foreach (config('locales.languages') as $key => $val){ ?>
            $('#course_details').find('tbody').append($('' +
                '<tr class="cloning_row" id="' + numberIncr + '">' +
                '<td>' +
                '<button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                '<td>' +
                '<span>{{ __('panel.topic_in_' . $key) }} (' + numberIncr + ')</span></td>' +
                '<td><input type="text" name="course_requirement[' + numberIncr +
                '][<?php echo $key; ?>]" class="course_requirement form-control"></td>' +
                '</tr>'));
            <?php } ?>
        });
    });



    $(document).on('click', '.delegated-btn', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();

    });
</script>
