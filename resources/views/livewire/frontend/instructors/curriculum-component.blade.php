<div>
    <p class="h6 py-3 text-muted">{{ __('transf.curriculum_description') }} </p>

    @foreach ($sections as $index => $section)
        <form wire:submit.prevent="storeSection">
            {{-- Course Section --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div>
                        <h5>{{ __('transf.section') }} : {{ $index }}</h5>
                    </div>
                    <div>
                        <a href="#"
                            wire:click.prevent="removeSection({{ $index }})">{{ __('transf.delete') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="products_table">

                        <tbody>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="sections[{{ $index }}][title]"
                                            class="form-control" wire:model="sections.{{ $index }}.title"
                                            placeholder="{{ __('transf.enter_a_title') }}" />
                                        <span
                                            class="input-group-text">{{ 80 - strlen($sections[$index]['title']) }}</span>
                                    </div>

                                    <!-- Display validation error for current section -->
                                    @error('sections.' . $index . '.title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="sections[{{ $index }}][objective]"
                                            class="form-control" wire:model="sections.{{ $index }}.objective"
                                            placeholder="{{ __('transf.enter_a_learning_objective') }}" />
                                        <span
                                            class="input-group-text">{{ 200 - strlen($sections[$index]['objective']) }}</span>
                                    </div>

                                    <!-- Display validation error for current section -->
                                    @error('sections.' . $index . '.objective')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </td>

                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </form>
    @endforeach


    <div class=" d-flex justify-content-between align-items-start">

        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-secondary" wire:click.prevent="addSection">
                    + {{ __('transf.add_another_section') }}
                </button>
            </div>
        </div>
        <div class="">
            <input class="btn btn-primary" type="submit" value="{{ __('transf.save') }}">
        </div>
    </div>

</div>
