<?php

namespace App\Http\Livewire\Instructors;

use App\Models\CourseCategory;
use App\Models\Specialization;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class InstructorsListCoponent extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;

    // ============ filter choice ==========//
    public $specials = [];
    protected $queryString = ['specials'];



    public function render()
    {

        // Get lecturers
        $lecturers = User::whereHasRoles('lecturer')->withCount('specializations');


        //get all course categories as menu 
        $course_categories_menu = CourseCategory::withCount('courses')->get();



        $specializations = Specialization::withCount(['users' => function ($query) {
            $query->WhereHasRoles('lecturer')->HasCourses();
        }])->get();

        $userspecializationIds = Specialization::whereIn('slug->' . app()->getLocale(), $this->specials)->pluck('id')->toArray();




        $lecturers->when($this->specials, function ($query) use ($userspecializationIds) {
            return $query->whereHas('specializations', function ($subQuery) use ($userspecializationIds) {
                $subQuery->whereIn('specialization_id', $userspecializationIds);
            });
        });


        $lecturers = $lecturers->HasCourses()->active()->get();


        return view(
            'livewire.instructors.instructors-list-coponent',
            [
                'lecturers' => $lecturers,
                'specializations'  =>  $specializations,
            ]
        );
    }
}
