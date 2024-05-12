<div>
    <form wire:submit.prevent="save">
        {{-- published_on and published_on_time  --}}
        <div class="row">
            <div class="col-sm-12 col-md-12 pt-4">
                <div class="form-group">
                    <label for="published_on"> {{ __('panel.published_date') }}</label>
                    <input type="text" id="published_on" name="published_on" wire:model="published_on"
                        class="form-control">
                    @error('published_on')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 pt-4">
                <div class="form-group">
                    <label for="published_on_time">{{ __('panel.published_time') }}</label>
                    <input type="text" id="published_on_time" name="published_on_time" wire:model="published_on_time"
                        class="form-control">
                    @error('published_on_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 pt-3">
                <label for="status" class="control-label col-md-2 col-sm-12 ">
                    <span>{{ __('panel.status') }}</span>
                </label>
                <select name="status" class="form-control" wire:model="status">
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
