<?php

namespace App\Http\Livewire\Frontend\Customer\Evaluation;

use App\Models\Evaluation;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\StudentEvaluation;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class StudentEvaluationComponent extends Component
{

    use LivewireAlert;

    //global variables
    public $currentStep = 1;
    public $totalSteps = 4;

    public $selectedEvaluation;
    public $questionCount;

    public $questionData = [];

    public $evaluation_completed = false;

    protected $listeners = ['evaluationChanged' => 'reloadData'];

    public function mount($selectedEvaluation)
    {
        $this->loadEvaluationData($selectedEvaluation);
    }


    public function reloadData($selectedEvaluationId)
    {
        if ($selectedEvaluationId) {
            $this->selectedEvaluation = Evaluation::with('questions.options')->find($selectedEvaluationId);
            $this->loadEvaluationData($this->selectedEvaluation);
        }
    }


    private function loadEvaluationData($evaluation)
    {
        $this->selectedEvaluation = $evaluation;

        if ($this->selectedEvaluation) {
            // Populate the questionData array
            $this->questionData = [
                'evaluation_id'                 => $this->selectedEvaluation->id,
                'evaluation_title'              => $this->selectedEvaluation->title,
                'evaluation_description'        => $this->selectedEvaluation->description,
                'evaluation_course_section_id'  => $this->selectedEvaluation->course_section_id,

                'questions' => $this->selectedEvaluation->questions->map(function ($question) {
                    return [
                        'question_id'               => $question->id,
                        'question_text'             => $question->question_text,
                        'question_type'             => $question->question_type,
                        'question_evaluation_id'    => $question->evaluation_id,

                        'options' => $question->options->map(function ($option) {
                            return [
                                'option_id'             => $option->id,
                                'option_text'           => $option->option_text,
                                'is_correct'            => $option->is_correct,
                                'option_question_id'    => $option->question_id,
                                'selected_option'       => '',
                            ];
                        })->toArray(),
                    ];
                })->toArray(),
            ];

            // Set the question count and total steps
            $this->questionCount = count($this->questionData['questions']);
            $this->totalSteps = $this->questionCount;

            // Reset evaluation_completed to false initially
            $this->evaluation_completed = false;

            // Check the evaluation if completed or not
            $studentEvaluation = StudentEvaluation::where('user_id', auth()->id())
                ->where('evaluation_id', $this->selectedEvaluation->id)
                ->first();

            if ($studentEvaluation && $studentEvaluation->completed_at) {
                $this->evaluation_completed = true;
            }
        }
    }



    public function render()
    {
        return view('livewire.frontend.customer.evaluation.student-evaluation-component');
    }


    public function previousStep()
    {
        $this->currentStep--;
    }

    public function nextStep()
    {
        $this->currentStep++;
    }

    public function finish()
    {
        $this->saveStepData();

        // // $this->validateStep();
        // $this->saveStepData();
        // return redirect()->route('admin.documents.show', $this->document_id);


        $this->alert('success', __('panel.evaluation_saved_successfully'));
    }


    public function saveStepData()
    {
        $evaluation = $this->selectedEvaluation;

        // Check if a StudentEvaluation record already exists for the user and evaluation
        $studentEvaluation = StudentEvaluation::where('user_id', auth()->id())
            ->where('evaluation_id', $evaluation->id)
            ->first();

        if ($studentEvaluation) {
            // Delete existing answers to clear previous data
            StudentAnswer::where('student_evaluation_id', $studentEvaluation->id)->delete();
        } else {
            // Create new StudentEvaluation if it doesn't exist
            $studentEvaluation = new StudentEvaluation();
            $studentEvaluation->user_id = auth()->id();
            $studentEvaluation->evaluation_id = $evaluation->id;
            $studentEvaluation->save();
        }

        $score = 0;

        foreach ($this->questionData['questions'] as $questionId => $question) {
            foreach ($question['options'] as $optionId => $option) {
                if (!empty($option['selected_option'])) { // Check if an option is selected
                    $studentAnswer = new StudentAnswer();
                    $studentAnswer->student_evaluation_id = $studentEvaluation->id;
                    $studentAnswer->question_id = $question['question_id'];
                    $studentAnswer->selected_option_id = $option['selected_option'];
                    $studentAnswer->save();

                    //You can calculate the score here if necessary
                    if ($option['is_correct'] && $option['selected_option'] == $option['option_id']) {
                        $score++;
                    }
                }
            }
        }

        $studentEvaluation->score = $score;
        $studentEvaluation->completed_at = Carbon::now();
        $studentEvaluation->save();

        if ($studentEvaluation && $studentEvaluation->completed_at) {
            $this->evaluation_completed = true;
        }
    }
}
