<div>
    <div class="row">
        <div class="col-sm-12 col-md-2 pt-3">
            <h2>صفحات النموذج</h2>
            <ul style="list-style: none;margin:0;padding:0;">
                @foreach ($evaluations as $index => $evaluation)
                    <li class="w-100 mb-1 d-flex justify-content-between"
                        style="background-color: {{ $currentEvaluationIndex == $index ? '#0162e8' : '#b9c2d8' }} ; border-width: 0;">
                        <a class="d-block" wire:click="setActiveEvaluation({{ $index }})" href="#"
                            style="padding: 9px 20px;line-height: 1.538;color:#fff;">
                            {{ $evaluation['title'] }} </a>

                        <a href="" wire:click.prevent="removeEvaluation({{ $currentEvaluationIndex }})"
                            class="d-block pt-2" style="padding: 9px 20px;line-height: 1.538;color:#fff;">
                            <i
                                class="fas fa-trash-alt {{ $currentEvaluationIndex == $index ? 'text-white' : 'text-danger' }}  me-3"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-between" style="">
                <!-- Button to add a new section -->
                <a wire:click.prevent="addEvaluation()" class="d-block pt-2" style="cursor: pointer;">
                    <i class="fas fa-plus-square text-primary me-3"></i> {{ __('panel.add_evaluation') }}
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-10 pt-3">
            @if (isset($evaluations[$currentEvaluationIndex]))
                <div class="card">
                    <div class="card-header mb-0 pb-0">
                        <h2> <i class="far fa-edit" style="color: #0162e8"></i> {{ __('panel.evaluation') }}
                            {{ $currentEvaluationIndex + 1 }}</h2>
                    </div>
                    <div class="card-body mt-0 pt-0">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 pt-3">
                                <label
                                    for="{{ $evaluations[$currentEvaluationIndex]['title'] }}">{{ __('panel.evaluation_title') }}</label>

                                <input type="text" class="form-control" id="evaluations.{{ $index }}.title"
                                    wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.title">

                                @error('evaluations.' . $currentEvaluationIndex . '.title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-8 pt-3">
                                <label for="{{ $evaluations[$currentEvaluationIndex]['description'] }}">
                                    {{ __('panel.description') }}
                                </label>

                                <input type="text" class="form-control"
                                    id="{{ $evaluations[$currentEvaluationIndex]['description'] }}"
                                    wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.description">

                                @error('evaluations.' . $currentEvaluationIndex . '.description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 pt-5">
                                <div class="row align-items-end mb-4 mb-md-0">
                                    <div class="col-md mb-4 mb-md-0">
                                        <h4>{{ __('panel.questions') }}</h4>
                                    </div>
                                    <div class="col-md-auto aos-init aos-animate" data-aos="fade-start">
                                        <a href=""
                                            wire:click.prevent="addQuestion({{ $currentEvaluationIndex }})">
                                            <i class="fas fa-plus-circle me-2"></i>
                                            <span>
                                                {{ __('panel.add_question') }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                @foreach ($evaluations[$currentEvaluationIndex]['questions'] as $questionIndex => $question)
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <div class="input-question p-2 "
                                                style="background: {{ $questionIndex == $activeQuestionIndex ? '#0162e8' : '#DDE2EF' }}  !important;">
                                                <span
                                                    class="input-question-text {{ $questionIndex == $activeQuestionIndex ? 'activequestion' : '' }}"
                                                    style="border:none;">
                                                    <span>
                                                        {{ __('panel.question') }}
                                                        {{ $questionIndex + 1 }}
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control"
                                                    wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.question_text"
                                                    aria-label="{{ __('transf.Enter a question Name') }}">

                                                <a class="input-question-text {{ $questionIndex == $activeQuestionIndex ? 'activequestion' : '' }}"
                                                    style="border:none; cursor: pointer;"
                                                    wire:click.prevent="removeQuestion({{ $currentEvaluationIndex }}, {{ $questionIndex }})">
                                                    <i
                                                        class="fas fa-trash-alt {{ $questionIndex == $activeQuestionIndex ? 'text-white' : 'text-danger' }} "></i>
                                                </a>

                                                <a class="input-question-text p-1 {{ $questionIndex == $activeQuestionIndex ? 'activequestion' : '' }}"
                                                    style="border:none; cursor: pointer;"
                                                    wire:click="setActiveQuestion({{ $currentEvaluationIndex }}, {{ $questionIndex }})">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </div>

                                        </div>
                                        @error('evaluations.' . $currentEvaluationIndex . '.questions.' . $questionIndex
                                            . '.pg_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-12 col-md-8 pt-5">
                                @foreach ($evaluations[$currentEvaluationIndex]['questions'] as $questionIndex => $question)
                                    {{-- options  --}}
                                    @if ($questionIndex == $activeQuestionIndex)
                                        <div class="row align-items-end mb-4 mb-md-0">
                                            <div class="col-md mb-4 mb-md-0">
                                                <h4>{{ __('panel.options') }}</h4>
                                            </div>
                                            <div class="col-md-auto aos-init aos-animate" data-aos="fade-start">
                                                <a href=""
                                                    wire:click.prevent="addOption({{ $currentEvaluationIndex }}, {{ $questionIndex }})">
                                                    <i class="fas fa-plus-circle me-2"></i>
                                                    <span>
                                                        {{ __('panel.add_option') }}
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        {{-- @foreach ($question['options'] as $optionIndex => $option) --}}
                                        @foreach ($evaluations[$currentEvaluationIndex]['questions'][$activeQuestionIndex]['options'] as $optionIndex => $option)
                                            <div class="card">
                                                <div class="card-header mb-0">
                                                    <div class="input-question mb-0" style="background: transparent;">
                                                        <div class="d-flex align-items-center">
                                                            <h3 class="mb-0 "
                                                                style="border:none;background:transparent">
                                                                <span>{{ __('panel.option') }}</span>
                                                                <span><small>{{ $optionIndex + 1 }}</small>
                                                                </span>
                                                            </h3>
                                                            <a class="d-block mx-2"
                                                                style="background: none;border:none;cursor: pointer;"
                                                                wire:click.prevent="removeOption({{ $currentEvaluationIndex }}, {{ $questionIndex }}, {{ $optionIndex }})">
                                                                <i class="fas fa-trash-alt text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body mt-0">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-question">
                                                                <label for="pv_name">{{ __('panel.pv_name') }}</label>
                                                                <input type="text" class="form-control"
                                                                    wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.options.{{ $optionIndex }}.pv_name">
                                                                @error('evaluations.' . $currentEvaluationIndex .
                                                                    '.questions.' . $questionIndex . '.options.' .
                                                                    $optionIndex . '.pv_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-question">
                                                                <label
                                                                    for="pv_question">{{ __('panel.pv_question') }}</label>
                                                                <input type="text" class="form-control"
                                                                    wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.options.{{ $optionIndex }}.pv_question">
                                                                @error('evaluations.' . $currentEvaluationIndex .
                                                                    '.questions.' . $questionIndex . '.options.' .
                                                                    $optionIndex . '.pv_question')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6 pt-3">
                                                            <label for="pv_type">{{ __('panel.pv_type') }}</label>
                                                            <select name="pv_type" class="form-control"
                                                                wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.options.{{ $optionIndex }}.pv_type">
                                                                <option value="1"
                                                                    {{ old('pv_type') == '1' ? 'selected' : null }}>
                                                                    {{ __('panel.pv_type_text') }}
                                                                </option>
                                                                <option value="2"
                                                                    {{ old('pv_type') == '2' ? 'selected' : null }}>
                                                                    {{ __('panel.pv_type_number') }}
                                                                </option>
                                                            </select>
                                                            @error('evaluations.' . $currentEvaluationIndex .
                                                                '.questions.' . $questionIndex . '.options.' . $optionIndex
                                                                . '.pv_type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div class="col-sm-12 col-md-6 pt-3">
                                                            <label
                                                                for="pv_required">{{ __('panel.pv_required') }}</label>
                                                            <select name="pv_required" class="form-control"
                                                                wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.options.{{ $optionIndex }}.pv_required">
                                                                <option value="1"
                                                                    {{ old('pv_required') == '1' ? 'selected' : null }}>
                                                                    {{ __('panel.yes') }}
                                                                </option>
                                                                <option value="0"
                                                                    {{ old('pv_required') == '0' ? 'selected' : null }}>
                                                                    {{ __('panel.no') }}
                                                                </option>
                                                            </select>
                                                            @error('evaluations.' . $currentEvaluationIndex .
                                                                '.questions.' . $questionIndex . '.options.' . $optionIndex
                                                                . '.pv_required')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{--  pv_details field --}}
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 pt-3">
                                                            <label for="pv_details">
                                                                {{ __('panel.pv_details') }}
                                                            </label>
                                                            <textarea name="pv_details" rows="10" class="form-control summernote"
                                                                wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.options.{{ $optionIndex }}.pv_details">
                                                                {!! old('pv_details') !!}
                                                            </textarea>
                                                            @error('evaluations.' . $currentEvaluationIndex .
                                                                '.questions.' . $questionIndex . '.options.' . $optionIndex
                                                                . '.pv_details')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
