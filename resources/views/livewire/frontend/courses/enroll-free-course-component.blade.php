<div>

    @php
        $userId = auth()->id();

        // Check if the user is already enrolled in the course
        $isEnrolled = App\Models\Order::where('user_id', $userId)
            ->whereHas('courses', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->exists();

    @endphp

    @if ($isEnrolled)
        <button class="btn btn-blue btn-block mb-6" type="button"
            name="button">{{ __('transf.btn_go_to_course') }}</button>
    @else
        <button wire:click.prevent="enrollCourse()" class="btn btn-orange btn-block mb-6" type="button"
            name="button">{{ __('transf.btn_enroll') }}</button>
    @endif

</div>
