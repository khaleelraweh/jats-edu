<div>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/mywizard.css') }}">

    <style>
        fieldset {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            padding: 15px;
        }

        legend {
            font-size: 1.2em;
            color: #333;
            font-weight: bold;
            width: fit-content;
            padding: 0 0.7rem;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
    </style>

    <h3 class="text-white">Evaluation Container </h3>


    {{-- @foreach ($selectedEvaluation->questions as $question)
        {{ $question->question_text }}
        <br>
        @foreach ($question->options as $option)
            <input type="{{ $question->question_type == 0 ? 'radio' : 'checkbox' }}">
            {{ $option->option_text }} <br>
        @endforeach
        <br><br>
    @endforeach  --}}




    {{-- ============================== start ========================== --}}

    <div class="card">
        <div class="card-header" style="background: rgb(47,45,81,0.8);color:white;">
            <div class="card-title">
                {{ $selectedEvaluation->title }}
            </div>
            <div class="card-subtitle">
                {{ $selectedEvaluation->description }}
            </div>
        </div>
        <div class="card-body">
            <div class="mywizard">
                <!------------- part 1 : Steps ------------->
                <div class="steps clearfix">
                    <ul role="tablist">

                        @isset($questionData)
                            @foreach ($questionData['questions'] as $key => $questionD)
                                <li role="tab" wire:click="directMoveToStep({{ $key + 1 }})"
                                    class="  {{ $currentStep == 1 ? 'first' : 'disabled' }}  {{ $currentStep == $key + 1 ? 'current' : '' }}"
                                    aria-disabled="  {{ $currentStep == 1 ? 'false' : 'true' }}">
                                    <a id="wizard1-t-{{ $key + 1 }}" href="#wizard1-h-1"
                                        aria-controls="wizard1-p-{{ $key + 1 }}">
                                        @if ($currentStep == 1)
                                            <span class="current-info audible">current step:</span>
                                        @endif

                                        <span class="number">{{ $key + 1 }}</span>
                                        <span class="title">
                                            {!! Str::words($questionD['question_text'], 3, ' ...') !!}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        @endisset
                    </ul>
                </div>
                <!------------- part 1 : Steps end ------------->

                <!------------- part 2 : Content ------------->
                <div class="mycontent">


                    {{-- <h3 id="wizard1-h-0" tabindex="-1" class="title {{ $currentStep == 1 ? 'current' : '' }} ">
                        {{ __('panel.document_template_data') }}
                    </h3>

                    <section id="wizard1-p-0" role="tabpanel" aria-labelledby="wizard1-h-0"
                        class="body {{ $currentStep == 1 ? 'current' : '' }}  step"
                        aria-hidden="{{ $currentStep == 1 ? 'false' : 'true' }}"
                        style="display: {{ $currentStep == 1 ? 'block' : 'none' }}">

                        <form method="post">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="row">
                                        welcome
                                    </div>



                                </div>


                            </div>
                        </form>
                    </section> --}}



                    <!---- related to dynamic steps --->
                    @isset($questionData)
                        @foreach ($questionData['questions'] as $questionIndex => $question)
                            <h3 id="wizard1-h-0" tabindex="-1"
                                class="title {{ $currentStep == $questionIndex + 1 ? 'current' : '' }} ">

                                <div class="row align-items-end mb-4 mb-md-0">
                                    <div class="col-md mb-4 mb-md-0">
                                        {{-- <h4>{{ $question['question_text'] }}</h4> --}}
                                    </div>
                                    <div class="col-md-auto aos-init aos-animate" data-aos="fade-start">
                                    </div>
                                </div>
                            </h3>
                            <section id="wizard1-p-0" role="tabpanel" aria-labelledby="wizard1-h-0"
                                class="body {{ $currentStep == $questionIndex + 1 ? 'current' : '' }}  step"
                                aria-hidden="{{ $currentStep == $questionIndex + 1 ? 'false' : 'true' }}"
                                style="display: {{ $currentStep == $questionIndex + 1 ? 'block' : 'none' }}">

                                <form method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">

                                            <fieldset>
                                                <legend>{{ $question['question_text'] }}</legend>


                                                <div class="row">
                                                    @foreach ($question['options'] as $optionIndex => $option)
                                                        <div class="col">

                                                            <input
                                                                type="{{ $question['question_type'] == 0 ? 'radio' : 'checkbox' }}"
                                                                wire:model.defer="questionData.{{ $questionIndex }}.options.{{ $optionIndex }}.option_value"
                                                                value="{{ $option['option_id'] }}">
                                                            {{ $option['option_text'] }}

                                                            {{-- @error('questionData.' . $pageIndex . '.groups.' . $groupIndex . '.variables.' . $variableIndex . '.pv_value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror --}}


                                                        </div>
                                                    @endforeach
                                                </div>


                                            </fieldset>

                                        </div>
                                    </div>
                                </form>

                            </section>
                        @endforeach
                    @endisset
                    <!---- end related to dynamic steps --->






                </div>
                <!------------- part 2 : Content end ------------->

                <!------------- part 2 : navagition wizard ------------->
                <div class="actions clearfix">
                    <ul role="menu" aria-label="Pagination">
                        <li class="{{ $currentStep == 1 ? 'disabled' : '' }}"
                            aria-disabled="{{ $currentStep == 1 ? 'true' : 'false' }}">
                            <a href="#previous" style="display: {{ $currentStep == 1 ? 'none' : 'none' }} ;"
                                role="menuitem">
                                Previous
                            </a>
                            <a href="#previous" wire:click="previousStep"
                                style="display: {{ $currentStep == 1 ? 'none' : 'block' }};" role="menuitem">
                                {{ __('panel.previous') }}
                            </a>
                        </li>

                        <li aria-hidden="false" aria-disabled="false"
                            style="display: {{ $currentStep == $totalSteps ? 'none' : 'block' }}">
                            <a href="#next" wire:click="nextStep" role="menuitem">
                                التالي
                            </a>
                        </li>

                        <li aria-hidden="true" style="display: {{ $currentStep == $totalSteps ? 'block' : 'none' }}">
                            <a href="#finish" wire:click="finish" role="menuitem">
                                {{ __('panel.finish') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <!------------- part 2 : navagition wizard end ------------->
            </div>
        </div>
    </div>









    {{-- =============================== end ========================== --}}


</div>
