<div>
    <h3 class="text-white">Evaluation Container </h3>

    <h3 class="text-white">{{ $selectedEvaluation->title }}</h3>
    <p class="text-white">{{ $selectedEvaluation->description }}</p>

    @foreach ($selectedEvaluation->questions as $question)
        {{ $question->question_text }}
        <br>
        @foreach ($question->options as $option)
            <input type="{{ $question->question_type == 0 ? 'radio' : 'checkbox' }}">
            {{ $option->option_text }} <br>
        @endforeach
        <br><br>
    @endforeach

</div>
