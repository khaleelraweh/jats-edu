<div wire:ignore>
    <form wire:submit.prevent="save">
        {{-- published_on --}}

        <div class="row">
            <div class="col-md-12 com-sm-12 pt-4">
                <label for="published_on" class="control-label">
                    <span>{{ __('panel.published_date') }}</span>
                    <span class="require red">*</span>
                </label>
                <div class="form-group">
                    <input type="text" name="published_on" class="form-control flatpickr"
                        wire:model.defer="published_on">
                    @error('published_on')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>



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

        <div class="row">
            <div class="col-sm-12 pt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>


@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            flatpickr('.flatpickr', {
                dateFormat: 'Y-m-d',
            });
        });
    </script>
@endpush
