{{-- course requirements contents   --}}
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
                @foreach (config('locales.languages') as $key => $val)
                    <tr class="cloning_row" id="0">
                        <td>#</td>
                        <td>{{ __('panel.topic_in_' . $key) }} (0)</td>
                        <td>
                            <input type="text" name="course_requirement[0][{{ $key }}]"
                                id="course_requirement" class="course_requirement form-control">
                            @error('course_requirement')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </td>

                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3" class="text-end">
                        <button type="button"
                            class="btn_add_requirement btn btn-primary">{{ __('panel.btn_add_another_topic') }}</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>







<script>
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

        // Add row functionality remains unchanged
        $(document).on('click', '.btn_add_requirement', function() {
            let trCount = $('#course_details').find('tr.cloning_row:last').length;
            let numberIncr = trCount > 0 ? parseInt($('#course_details').find('tr.cloning_row:last')
                .attr('id')) + 1 : 0;
            let isValid = true;

            // Check if any of the existing fields are empty
            $('#course_details').find('input.course_requirement').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false; // Exit the loop if any field is empty
                }
            });

            if (!isValid) {
                alert('Please fill in all existing fields before adding a new row.');
                return false; // Prevent adding a new row if existing fields are empty
            }

            // Add new row
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
