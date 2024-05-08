<div>
    <form action="">
        {{-- published_on and published_on_time  --}}
        <div class="row">
            <div class="col-sm-12 col-md-12 pt-4">
                <div class="form-group">
                    <label for="published_on"> {{ __('panel.published_date') }}</label>
                    <input type="text" id="published_on" name="published_on"
                        value="{{ old('published_on', \Carbon\Carbon::parse($course->published_on)->Format('Y-m-d')) }}"
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
                    <input type="text" id="published_on_time" name="published_on_time"
                        value="{{ old('published_on_time', \Carbon\Carbon::parse($course->published_on)->Format('h:i A')) }}"
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
                <select name="status" class="form-control">
                    <option value="1" {{ old('status', $course->status) == '1' ? 'selected' : null }}>
                        {{ __('panel.status_active') }}
                    </option>
                    <option value="0" {{ old('status', $course->status) == '0' ? 'selected' : null }}>
                        {{ __('panel.status_inactive') }}
                    </option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </form>
</div>
