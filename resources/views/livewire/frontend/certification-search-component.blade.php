<div class="container">
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="search">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="certificate_code"> {{ __('panel.certificate_number') }}</label>
                        <input type="text" name="certificate_code" id="certificate_code" class="form-control"
                            wire:model.defer="certificate_code">
                        @error('certificate_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">{{ __('panel.search') }}</button>
            </form>
        </div>
    </div>

    <!-- Loading Indicator -->
    @if ($isLoading)
        <div class="text-center mt-3">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">{{ __('panel.loading') }}...</span>
            </div>
        </div>
    @endif

    <!-- Certificate Details -->
    @isset($certificate)
        <div class="card mt-3">
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <td>{{ __('panel.certificate_code') }}:</td>
                        <td>{{ $certificate->cert_code ?? __('panel.unavailable') }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('panel.trainee_name') }}:</td>
                        <td>{{ $certificate->full_name ?? __('panel.unavailable') }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('panel.course_name') }}:</td>
                        <td>{{ $certificate->course->title ?? __('panel.unavailable') }}</td>
                    </tr>
                    <tr>
                        <td> {{ __('panel.release_date') }} :</td>
                        <td>{{ $certificate->date_of_issue ?? __('panel.unavailable') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ $cert_image_url }}" alt="Marked Certificate"
                            style="width: 70%; display: block; margin: auto;">
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Handle case when no certificate is found -->
        @if (!$isLoading)
            <div class="alert alert-warning mt-3">
                <strong> {{ __('panel.certificate_not_found') }}!</strong>
            </div>
        @endif
    @endisset
</div>
