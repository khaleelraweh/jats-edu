<div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="text-center">
                @if ($databaseDataValid && !$errors->any())
                    <div class="mb-4">
                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                    </div>
                    <div>

                        <h5>{{ __('transf.Course Data Confirmed successfully') }}</h5>
                        <p class="text-muted">{{ __('transf.Course Data Confirmed successfully tips') }}</p>

                    </div>
                @else
                    <div class="mb-4">
                        <i class="mdi mdi-alert-circle-outline text-warning display-4"></i>
                    </div>
                    <div>

                        <h5>{{ __('transf.Course Data Confirmed successfully') }}</h5>
                        <p class="text-muted">{{ __('transf.Confirm the compulsory course information tips') }}</p>

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
