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
    public $categoryInputs = [];
    protected $queryString = ['categoryInputs'];



    public function render()
    {

        // Get lecturers
        $lecturers = User::whereHasRoles('lecturer')->withCount('specializations');
        // ->active()
        // ->HasCourses()
        // // ->inRandomOrder()
        // ->get();




        //get all course categories as menu 
        $course_categories_menu = CourseCategory::withCount('courses')->get();



        $specializations = Specialization::withCount(['users' => function ($query) {
            $query->WhereHasRoles('lecturer')->HasCourses();
        }])->get();

        $courseCategoryIds = CourseCategory::whereIn('slug->' . app()->getLocale(), $this->categoryInputs)->pluck('id')->toArray();

        $lecturers = $lecturers->when($this->categoryInputs, function ($query) use ($courseCategoryIds) {
            return $query->whereHasCoursesWithCategory($courseCategoryIds);
        });

        $lecturers = $lecturers->active()->get();


        return view(
            'livewire.instructors.instructors-list-coponent',
            [
                'course_categories_menu' => $course_categories_menu,
                'lecturers' => $lecturers,
                'specializations'  =>  $specializations,
            ]
        );
    }
}
