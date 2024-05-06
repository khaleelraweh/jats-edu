<div>
    <p class="h6 py-3 text-muted">{{ __('transf.curriculum_description') }} </p>

    <form wire:submit.prevent="storeSection">

        {{-- Course Section --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-start">
                <div>
                    <h5>Section</h5>
                </div>
                <div>
                    status
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>{{ __('transf.section') }} </th>
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
                                            placeholder="{{ __('transf.example:define_the_roles_and_responsibilities_of_a_project_manager') }}" />
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
        <div class="">
            <input class="btn btn-primary" type="submit" value="{{ __('transf.save') }}">
        </div>
    </form>

</div>
