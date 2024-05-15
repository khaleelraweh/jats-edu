<div>
    <header class="d-flex justify-content-end">
        <div class="completed-section-badge">
            @if ($databaseDataValid && !$errors->any())
                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
            @endif
        </div>
    </header>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="text-center">
                <div class="mb-4">
                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                </div>
                <div>
                    <h5>{{ __('transf.Course Data Confirmed successfully') }}</h5>
                    <p class="text-muted">{{ __('transf.Course Data Confirmed successfully tips') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
