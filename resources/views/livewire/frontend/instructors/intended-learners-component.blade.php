<div>



    <p class="h6 py-3 text-muted">{{ __('transf.intended_description') }} </p>

    <form wire:submit.prevent="storeObjective">


        {{-- Objectives --}}
        <div class="card">
            <div class="card-header">
                <h4>{{ __('transf.what_will_students_learn_in_your_course?') }}</h4>
                <h6>{{ __('transf.what_will_students_learn_tips') }}</h6>
            </div>

            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>{{ __('transf.objective') }} </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objectives as $index => $objective)
                            <tr>
                                <td>
                                    <input type="text" name="objectives[{{ $index }}][title]"
                                        class="form-control" wire:model="objectives.{{ $index }}.title"
                                        placeholder="{{ __('transf.example:define_the_roles_and_responsibilities_of_a_project_manager') }}" />
                                </td>
                                <td>
                                    <a href="#"
                                        wire:click.prevent="removeObjective({{ $index }})">{{ __('transf.delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addObjective">
                            + {{ __('transf.add_another_objective') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Requirements --}}

        <!-- Display validation errors -->
        @if ($errors->has('requirements'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->get('requirements') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Display validation errors for requirements -->
        {{-- @error('requirements.*.title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <div class="card">
            <div class="card-header">
                <h4>{{ __('transf.what_are_the_requirements_or_prerequisites_for_taking_your_course?') }}</h4>
                <h6>{{ __('transf.what_are_the_requirements_tips') }}</h6>
            </div>

            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>{{ __('transf.requirement') }} </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requirements as $index => $requirement)
                            <tr>
                                <td>
                                    <input type="text" name="requirements[{{ $index }}][title]"
                                        class="form-control" wire:model="requirements.{{ $index }}.title"
                                        placeholder="{{ __('transf.example:no_programming_experience_needed.you_will_learn_everything_you_need_to_know') }}" />
                                    <!-- Display validation error for current requirement -->
                                    @error('requirements.' . $index . '.title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </td>
                                <td>
                                    <a href="#"
                                        wire:click.prevent="removeRequirement({{ $index }})">{{ __('transf.delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addRequirement">
                            + {{ __('transf.add_another_requirement') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <br />
        <div class="">
            <input class="btn btn-primary" type="submit" value="{{ __('transf.save_objective') }}">
        </div>
    </form>
</div>
