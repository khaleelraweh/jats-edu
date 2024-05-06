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
        {{-- <form> --}}

        {{-- Sections --}}
        @foreach ($sections as $index => $section)
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div>
                        <!-- Input field for section title -->
                        <input type="text" class="form-control" wire:model="sections.{{ $index }}.title"
                            placeholder="{{ __('Section Title') }}">
                    </div>
                    <div>
                        <!-- Button to save section title -->
                        <button class="btn btn-sm btn-primary" wire:click="saveSection({{ $index }})">
                            {{ __('Save Section') }}
                        </button>
                        <!-- Button to remove section -->
                        <button class="btn btn-sm btn-danger" wire:click.prevent="removeSection({{ $index }})">
                            {{ __('Remove Section') }}
                        </button>
                        <!-- Button to add a new lesson for this section -->
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addLesson({{ $index }})">
                            + {{ __('Add Lesson') }}
                        </button>
                        <!-- Button to save lessons for this section -->
                        <button class="btn btn-sm btn-success"
                            wire:click.prevent="saveLessonsInSection({{ $index }})">
                            {{ __('Save Lessons') }}
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    {{-- Lessons for this section --}}
                    <table class="table">
                        <thead>
                            <tr>

                                <th>{{ __('Lesson Title') }}</th>
                                <th>{{ __('url') }}</th>
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
                                        <input type="text" class="form-control"
                                            wire:model="sections.{{ $index }}.lessons.{{ $lessonIndex }}.url"
                                            placeholder="{{ __('url') }}">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"
                                            wire:model="sections.{{ $index }}.lessons.{{ $lessonIndex }}.duration_minutes"
                                            placeholder="{{ __('Duration in minutes') }}">
                                    </td>
                                    <td>
                                        <!-- Button to remove lesson -->
                                        <button class="btn btn-sm btn-danger"
                                            wire:click.prevent="removeLesson({{ $index }}, {{ $lessonIndex }})">
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

        <div class="d-flex justify-content-between" style="">
            <!-- Button to add a new section -->
            <button class="btn btn-primary" wire:click.prevent="addSection()">
                + {{ __('Add Section') }}
            </button>

            <div>
                <input class="btn btn-primary" type="submit" value="{{ __('transf.save_in_one_click') }}">
            </div>
        </div>
    </form>
</div>
