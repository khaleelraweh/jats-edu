<div class="container" x-data="{ loading: false }" x-init="@this.on('startLoading', () => loading = true);
@this.on('stopLoading', () => loading = false);">
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="search">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="certificate_code">{{ __('panel.certificate_number') }}:</label>
                        <input type="text" name="certificate_code" id="certificate_code" class="form-control"
                            wire:model.defer="certificate_code">
                        @error('certificate_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Search</button>
            </form>
        </div>
    </div>

    <!-- Loader -->
    {{-- <div x-show="loading" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}

    <!-- Certificate Details -->
    @if ($certificate)
        <div class="card mt-3" wire:key="{{ now() }}" x-show="!loading">
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <td>كود الشهادة:</td>
                        <td>{{ $certificate->cert_code }}</td>
                    </tr>
                    <tr>
                        <td>اسم المتدرب:</td>
                        <td>{{ $certificate->full_name }}</td>
                    </tr>
                    <tr>
                        <td>اسم الدورة التدريبية:</td>
                        <td>{{ $certificate->course->title }}</td>
                    </tr>
                    <tr>
                        <td>تاريخ الاصدار :</td>
                        <td>{{ $certificate->date_of_issue }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-3" wire:key="{{ now() }}" x-show="!loading">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ $cert_image_url }}" alt="Marked Certificate"
                            style="width: 70%; display: block; margin: auto;">
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
