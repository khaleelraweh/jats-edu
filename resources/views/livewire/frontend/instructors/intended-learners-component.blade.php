<div>


    <p class="h6 py-3 text-muted">{{ __('transf.intended_description') }} </p>

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
                                            wire:click.prevent="removeObjective({{ $index }})">Delete</a>
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
            <input class="btn btn-primary" type="submit" value="Save Order">
        </div>
    </form>
</div>
