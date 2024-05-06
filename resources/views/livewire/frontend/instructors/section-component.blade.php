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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-start">
                <div>
                    <h4>{{ __('transf.course_sections') }}</h4>
                    <h6>{{ __('transf.course_sections_tips') }}</h6>
                    <!-- Display validation errors -->
                    @if ($errors->has('sections'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('sections') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div>
                    @if ($sectionsValid || ($formSubmitted && !$errors->any()))
                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="sections_table">
                    <thead>
                        <tr>
                            <th>{{ __('transf.section_title') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $index => $section)
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="sections[{{ $index }}][title]"
                                            class="form-control" wire:model="sections.{{ $index }}.title"
                                            placeholder="{{ __('transf.section_title_placeholder') }}" />
                                        <span
                                            class="input-group-text">{{ 160 - strlen($sections[$index]['title']) }}</span>
                                    </div>

                                    <!-- Display validation error for current section -->
                                    @error('sections.' . $index . '.title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <a href="#"
                                        wire:click.prevent="removeSection({{ $index }})">{{ __('transf.delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addSection">
                            + {{ __('transf.add_another_section') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <br />
        <div>
            <input class="btn btn-primary" type="submit" value="{{ __('transf.save') }}">
        </div>
    </form>
</div>
