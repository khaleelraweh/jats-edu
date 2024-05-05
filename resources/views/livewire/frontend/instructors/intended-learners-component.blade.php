<div>


    <p class="h6 py-3 text-muted">{{ __('transf.intended_description') }} </p>

    {{-- @foreach ($course->requirements as $item)
        <?php
        $loopIndex = $loop->index;
        ?>
        @foreach (config('locales.languages') as $key => $val)
            <tr class="cloning_row" id="{{ $loopIndex }}">
                <td style="width: 30px !important;">
                    @if ($loopIndex == 0)
                        {{ '#' }}
                    @else
                        <button type="button" class="btn btn-danger btn-sm delegated-btn"><i
                                class="fa fa-minus"></i></button>
                    @endif
                </td>
                <td>{{ __('panel.requirement_in_' . $key) }} ({{ $loopIndex }})</td>
                <td>
                    <input type="text" name="course_requirement[{{ $loopIndex }}][{{ $key }}]"
                        id="course_requirement"
                        value="{{ old('course_requirement' . $key, $item->getTranslation('title', $key)) }}"
                        class="course_requirement form-control">
                    @error('course_requirement[{{ $loopIndex }}]' . $key)
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
        @endforeach
    @endforeach --}}

    <form action="" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">
                <h4>{{ __('transf.what_will_students_learn_in_your_course?') }}</h4>
                <h6>{{ __('transf.what_will_students_learn_tips') }}</h6>
            </div>

            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>Lang</th>
                            <th>{{ __('transf.objective') }} </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objectives as $index => $objective)
                            @foreach (config('locales.languages') as $key => $val)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>
                                        <input type="text" name="objectives[{{ $index }}][quantity]"
                                            class="form-control" wire:model="objectives.{{ $index }}.quantity" />
                                    </td>
                                    <td>
                                        <a href="#"
                                            wire:click.prevent="removeObjective({{ $index }})">{{ __('transf.delete') }}</a>
                                    </td>
                                </tr>
                            @endforeach
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
        <br />
        <div>
            <input class="btn btn-primary" type="submit" value="{{ __('transf.save_objective') }}">
        </div>
    </form>
</div>
