<div>

    <header class="d-flex justify-content-end">
        <div class="completed-section-badge">
            @if ($databaseDataValid || ($formSubmitted && !$errors->any()))
                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
            @endif
        </div>
    </header>

    <form wire:submit.prevent="save">
        {{-- published_on --}}

        <div class="row">
            <div class="col-md-12 com-sm-12 pt-4">
                <label for="published_on" class="control-label">
                    <span>{{ __('panel.published_date') }}</span>
                    <span class="require red">*</span>
                </label>
                <div class="form-group">
                    <input type="text" name="published_on" class="form-control flatpickr_publihsed_on"
                        wire:model="published_on" readonly>
                    @error('published_on')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>


        @if (auth()->user()->hasRole('admin'))
            <div class="row">
                <div class="col-md-12 col-sm-12 pt-3" wire.ignore>
                    <label for="status" class="control-label col-md-2 col-sm-12 ">
                        <span>{{ __('panel.status') }}</span>
                    </label>

                    <select name="status" class="form-control" wire:model.defer="status">
                        <option value="1">{{ __('panel.status_active') }}</option>
                        <option value="0">{{ __('panel.status_inactive') }}</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif


        <div class="row">
            <div class="col-sm-12 pt-3">
                <button type="submit" class="btn btn-primary">{{ __('transf.Save changes') }}</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        var tinymceLanguage = '{{ app()->getLocale() }}'; // Get the current locale from Laravel config
        var flatPickrLanguage = '{{ app()->getLocale() }}';
    </script>

    <script>
        document.addEventListener('livewire:load', function() {
            flatpickr('.flatpickr_publihsed_on', {
                enableTime: true,
                dateFormat: "Y/m/d h:i K",
                defaultDate: '{{ $published_on ?? now()->format('Y/m/d h:i A') }}',
                // minDate: "today",
                locale: typeof flatPickrLanguage !== 'undefined' ? flatPickrLanguage : 'en',

                onChange: function(selectedDates, dateStr, instance) {
                    @this.set('published_on',
                        dateStr); // Update Livewire component's published_on property
                }
            });
        });
    </script>
@endpush
