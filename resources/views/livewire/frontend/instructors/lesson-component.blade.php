<div>
    <header class="d-flex justify-content-end">
        <div class="completed-section-badge">
            @if ($databaseDataValid || ($formSubmitted && !$errors->any()))
                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
            @endif
        </div>
    </header>
    <p class="h6 py-3 text-muted">{{ __('transf.intended_description') }}</p>

    <form wire:submit.prevent="storeSections">

        {{-- Sections --}}
        @foreach ($sections as $index => $section)
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div>
                        <h4>{{ $section['title'] }}</h4>
                    </div>
                    <div>
                        <!-- Button to add a new lesson for this section -->
                        <button class="btn btn-sm btn-secondary" wire:click="addLesson({{ $index }})">
                            + {{ __('Add Lesson') }}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Lessons for this section --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Lesson Title') }}</th>
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($section['lessons'] as $lessonIndex => $lesson)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model="sections.{{ $index }}.lessons.{{ $lessonIndex }}.title"
                                            placeholder="{{ __('Lesson Title') }}">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"
                                            wire:model="sections.{{ $index }}.lessons.{{ $lessonIndex }}.duration_minutes"
                                            placeholder="{{ __('Duration in minutes') }}">
                                    </td>
                                    <td>
                                        <!-- Button to remove lesson -->
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="removeLesson({{ $index }}, {{ $lessonIndex }})">
                                            {{ __('Remove') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <br />
        <div>
            <input class="btn btn-primary" type="submit" value="{{ __('transf.save') }}">
        </div>
    </form>
</div>
