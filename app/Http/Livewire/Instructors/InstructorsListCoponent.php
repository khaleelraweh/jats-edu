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
    public $selectedNames = [];
    protected $queryString = ['specials', 'selectedNames'];


    public function render()
    {


        // Query for filter menu 
        $specializations_menu = Specialization::withCount(['users' => function ($query) {
            $query->whereHasRoles('lecturer')->has('courses');
        }])->get();

        // Get the IDs of selected specializations
        $userspecializationIds = Specialization::whereIn('slug->' . app()->getLocale(), $this->specials)->pluck('id')->toArray();


        // Retrieve all lecturers for the filter menu
        $lecturers_menu = User::whereHasRoles('lecturer')->hasCourses()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get()
            ->groupBy(function ($user) {
                return $user->first_name . ' ' . $user->last_name;
            })
            ->map(function ($group) {
                return $group->count();
            });


        // dd($this->selectedName);
        // Get lecturers
        $lecturers = User::whereHasRoles('lecturer')
            ->when($this->specials, function ($query) use ($userspecializationIds) {
                return $query->whereHas('specializations', function ($subQuery) use ($userspecializationIds) {
                    $subQuery->whereIn('specialization_id', $userspecializationIds);
                });
            })
            ->when($this->selectedNames, function ($query) {
                return $query->where(function ($subQuery) {
                    foreach ($this->selectedNames as $fullName) {
                        $subQuery->orWhereRaw('CONCAT(first_name, " ", last_name) LIKE ?', ["%{$fullName}%"]);
                    }
                });
            })
            ->has('courses')
            ->active()
            ->get();

        return view(
            'livewire.instructors.instructors-list-coponent',
            [
                'specializations_menu'  =>  $specializations_menu,
                'lecturers_menu'       =>  $lecturers_menu,
                'lecturers' => $lecturers,
            ]
        );
    }
}
