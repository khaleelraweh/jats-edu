<div>
    <form wire:submit.prevent="save">
        {{-- course price  --}}
        <div class="row">
            <div class="col-md-12 col-sm-12 pt-3">
                <label for="price"> {{ __('panel.price') }} </label>
                <input type="text" name="price" wire:model.defer="price" id="price"
                    value="{{ old('price', $course->price) }}" class="form-control">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- offer price  --}}
        <div class="row">
            <div class="col-md-12 col-sm-12 pt-3">
                <label for="offer_price"> {{ __('panel.offer_price') }} </label>
                <input type="text" id="offer_price" name="offer_price" wire:model.defer="offer_price"
                    value="{{ old('offer_price', $course->offer_price) }}" class="form-control">
                @error('offer_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- offer_ends  --}}
        <div class="row">
            <div class="col-md-12 com-sm-12 pt-4">
                <label for="offer_ends" class="control-label"><span> {{ __('panel.offer_ends') }}
                    </span><span class="require red">*</span></label>
                <div class="form-group">
                    <input type="text" id="offer_ends" name="offer_ends" wire:model.defer="offer_ends"
                        value="{{ old('offer_ends', $course->offer_ends) }}" class="form-control">
                    @error('offer_ends')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 pt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
