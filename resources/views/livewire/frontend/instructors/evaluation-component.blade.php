<div>
    <style>
        .activeQuestion {
            color: #fff !important;
        }

        .form-control {
            border-radius: 1.5rem;
        }

        .add-question {

            display: inline-block;
            margin-bottom: .5rem;
            border: 1px solid;
            border-radius: 15px;
            padding-left: 10px;
            padding-right: 6px;
            padding-top: 5px;
            padding-bottom: 5px;
            color: #0f9cf3;
            border-color: rgba(0, 0, 0, .1);
        }

        .add-question:hover {
            background-color: #0f9cf3;
            color: white !important;
        }


        .input-question {
            background: #0162e8 !important;
            padding: 15px !important;
            border-radius: 7px;
        }

        .input-question .input-question-text {
            display: inline-block;
            margin-bottom: 7px !important;
        }

        .input-question .input-question-field {
            border-radius: 20px;
        }

        .remove-question {
            order: none;
            /* margin-top: 15px !important; */
            display: inline-block;
            /* margin: 0 15px; */
            margin: 0 6px;
        }
    </style>

    <header class="d-flex justify-content-end">
        <div class="completed-section-badge">
            @if ($databaseDataValid || ($formSubmitted && !$errors->any()))
                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
            @endif
        </div>
    </header>

    <div class="row">
        <div class="col-sm-12 col-md-3 pt-3">
            <h3>التقييمات</h3>



            <ul style="list-style: none;margin:0;padding:0;">
                @foreach ($evaluations as $index => $evaluation)
                    <li class="w-100 mb-1 d-flex justify-content-between"
                        style="border-radius:4px;background-color: {{ $currentEvaluationIndex == $index ? '#0162e8' : '#b9c2d8' }} ; border-width: 0;">
                        <a class="d-block" wire:click="setActiveEvaluation({{ $index }})" href="#"
                            style="padding: 9px 20px;line-height: 1.538;color:#fff;">
                            {{ $evaluation['title'] }}
                        </a>

                        <a href="" wire:click.prevent="removeEvaluation({{ $currentEvaluationIndex }})"
                            class="d-block pt-2" style="padding: 10px 6px 6px 0;line-height: 1.538;color:#fff;">
                            <i
                                class="fas fa-trash-alt {{ $currentEvaluationIndex == $index ? 'text-white' : 'text-danger' }}  me-3"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-between" style="">
                <!-- Button to add a new section -->
                <a wire:click.prevent="addEvaluation()" class="d-block pt-3" style="cursor: pointer;">
                    <i class="fas fa-plus-square text-primary "></i> {{ __('panel.add_evaluation') }}
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-9 pt-3">
            @if (isset($evaluations[$currentEvaluationIndex]))
                <div class="card">
                    <div class="card-header mb-0 pb-0" style="padding: .625rem .625rem !important;">

                        <div class="holder d-flex justify-content-between">
                            <h2>
                                <i class="far fa-edit" style="color: #0162e8"></i>
                                {{ __('panel.evaluation') }}
                                {{ $currentEvaluationIndex + 1 }}
                            </h2>
                            <button wire:click.prevent="saveEvaluationBtn" class="btn btn-primary">Save </button>
                        </div>

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
                            <div class="col-sm-12 col-md-12 pt-3">
                                <label for="course_section_id">{{ __('panel.course_section') }}</label>
                                <select name="course_section_id" class="form-control"
                                    wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.course_section_id">
                                    @forelse ($course_sections as $course_section)
                                        <option value="{{ $course_section->id }}"
                                            {{ old($course_section->id) == '1' ? 'selected' : null }}>
                                            {{ $course_section->title }}
                                        </option>
                                    @empty
                                        No course section selected
                                    @endforelse
                                </select>

                                @error('evaluations.' . $currentEvaluationIndex . '.course_section_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <div class="row align-items-end mb-4 mb-md-0">
                                    <div class="col-md mb-4 mb-md-0">
                                        <h4>{{ __('panel.questions') }}</h4>
                                    </div>
                                    <div class="col-md-auto aos-init aos-animate " data-aos="fade-start">
                                        <a href="" class="add-question"
                                            wire:click.prevent="addQuestion({{ $currentEvaluationIndex }})">
                                            <i class="fas fa-plus-circle me-2 "></i>
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
                                                    class="input-question-text {{ $questionIndex == $activeQuestionIndex ? 'activeQuestion' : '' }}"
                                                    style="border:none;">
                                                    <span>
                                                        {{ __('panel.question') }}
                                                        {{ $questionIndex + 1 }}
                                                    </span>
                                                </span>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-9">
                                                        <input type="text" class="form-control input-question-field "
                                                            wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.question_text"
                                                            aria-label="{{ __('transf.Enter a question Name') }}">
                                                    </div>
                                                    <div class="col-sm-12 col-md-2 px-0 pt-3 pt-md-0">
                                                        {{-- <label for="question_type">{{ __('panel.question_type') }}</label> --}}
                                                        <select name="question_type" class="form-control"
                                                            wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.question_type">
                                                            <option value="1"
                                                                {{ old('question_type') == '1' ? 'selected' : null }}>
                                                                {{ __('panel.single_choice') }}
                                                            </option>
                                                            <option value="2"
                                                                {{ old('question_type') == '2' ? 'selected' : null }}>
                                                                {{ __('panel.multiple_choice') }}
                                                            </option>
                                                        </select>





                                                        @error('evaluations.' . $currentEvaluationIndex . '.questions.'
                                                            . $questionIndex . '.question_type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div
                                                        class="col-sm-12 col-md-1 d-flex justify-content-center align-items-center">
                                                        <a class=" remove-question {{ $questionIndex == $activeQuestionIndex ? 'activeQuestion' : '' }}"
                                                            style="border:none; cursor: pointer;"
                                                            wire:click.prevent="removeQuestion({{ $currentEvaluationIndex }}, {{ $questionIndex }})">
                                                            <i
                                                                class="fas fa-trash-alt {{ $questionIndex == $activeQuestionIndex ? 'text-white' : 'text-danger' }} "></i>
                                                        </a>

                                                        <a class=" p-1 {{ $questionIndex == $activeQuestionIndex ? 'activeQuestion' : '' }}"
                                                            style="border:none; cursor: pointer;"
                                                            wire:click="setActiveQuestion({{ $currentEvaluationIndex }}, {{ $questionIndex }})">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    </div>



                                                </div>
                                            </div>

                                        </div>
                                        @error('evaluations.' . $currentEvaluationIndex . '.questions.' . $questionIndex
                                            . '.pg_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- options  --}}
                                    @if ($questionIndex == $activeQuestionIndex)
                                        <div class="row align-items-end mb-4 mb-md-0">
                                            <div class="col-md mb-4 mb-md-0">
                                                <h4 style="margin-bottom: 15px;">{{ __('panel.options') }}</h4>
                                            </div>
                                            <div class="col-md-auto aos-init aos-animate" data-aos="fade-start">
                                                <a href="" style="display: inline-block;margin-bottom: 15px;"
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
                                                    <div class="input-option mb-0" style="background: transparent;">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h3 class="mb-0 "
                                                                style="border:none;background:transparent ; font-size: 20px;">
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
                                                        <div class="col-sm-12 col-md-8">
                                                            <div class="form-question">
                                                                <label
                                                                    for="option_text">{{ __('panel.option_text') }}</label>
                                                                <input type="text" class="form-control"
                                                                    wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.options.{{ $optionIndex }}.option_text">
                                                                @error('evaluations.' . $currentEvaluationIndex .
                                                                    '.questions.' . $questionIndex . '.options.' .
                                                                    $optionIndex . '.option_text')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 ">
                                                            <label
                                                                for="is_correct">{{ __('panel.is_correct') }}</label>
                                                            <select name="is_correct" class="form-control"
                                                                wire:model.defer="evaluations.{{ $currentEvaluationIndex }}.questions.{{ $questionIndex }}.options.{{ $optionIndex }}.is_correct">
                                                                <option value="1"
                                                                    {{ old('is_correct') == '1' ? 'selected' : null }}>
                                                                    {{ __('panel.yes') }}
                                                                </option>
                                                                <option value="0"
                                                                    {{ old('is_correct') == '0' ? 'selected' : null }}>
                                                                    {{ __('panel.no') }}
                                                                </option>
                                                            </select>
                                                            @error('evaluations.' . $currentEvaluationIndex .
                                                                '.questions.' . $questionIndex . '.options.' . $optionIndex
                                                                . '.is_correct')
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
