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

                        {{-- @if (!$sendViewStatus || !$course->send_for_review == true) --}}
                        @if ($course->course_status == 1)
                            <button class="btn btn-sm btn-primary px-2 py-2" wire:click.prevent="sendForReview()">
                                {{ __('transf.Send For Review') }}
                            </button>
                        @endif

                        @if ($course->course_status == 2)
                            <span
                                class="d-flex justify-content-center align-items-center bg-info  px-1 py-2 text-white border rounded">
                                <i class="mdi mdi-book-open-page-variant text-white display-6 me-3"></i>
                                {{ __('transf.Course send for admin review successfully!') }}
                            </span>
                        @endif
                        @if ($course->course_status == 3)
                            <span
                                class="d-flex justify-content-center align-items-center bg-info  px-1 py-2 text-white border rounded">
                                <i class="mdi mdi-check-circle-outline text-white display-6 me-3"></i>
                                {{ __('transf.Course review finished by adminstration successfully!') }}
                            </span>
                        @endif
                        @if ($course->course_status == 4)
                            <span
                                class="d-flex justify-content-center align-items-center bg-info  px-1 py-2 text-white border rounded">
                                <i class="mdi mdi-check-circle-outline text-white display-6 me-3"></i>
                                {{ __('transf.The course was successfully accepted and published by the administration') }}
                            </span>
                        @endif
                        @if ($course->course_status == 5)
                            <span
                                class="d-flex justify-content-center align-items-center bg-info  px-1 py-2 text-white border rounded">
                                <i class="mdi mdi-alert-circle text-white display-6 me-3"></i>
                                {{ __('transf.The course was rejected because it did not meet our publishing standards. Please check the course contents and try again') }}
                            </span>
                        @endif



                    </div>
                @else
                    <div class="mb-4">
                        <i class="mdi mdi-alert-circle-outline text-warning display-4"></i>
                    </div>
                    <div>

                        <h5>{{ __('transf.Confirm the compulsory course information') }}</h5>
                        <p class="text-muted">{{ __('transf.Confirm the compulsory course information tips') }}</p>

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
