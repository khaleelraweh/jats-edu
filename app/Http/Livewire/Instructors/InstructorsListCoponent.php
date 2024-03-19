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
    public $selectedSpecializations = [];
    public $searchQuery = '';
    public $selectedNames = [];
    public $selectedRatings = [];
    protected $queryString = ['selectedSpecializations', 'selectedNames', 'searchQuery', 'selectedRatings'];


    public function render()
    {


        // Query for filter menu 
        $specializations_menu = Specialization::withCount(['users' => function ($query) {
            $query->whereHasRoles('lecturer')->has('courses');
        }])->get();

        // Get the IDs of selected specializations
        $selectedSpecializationIds = Specialization::whereIn('slug->' . app()->getLocale(), $this->selectedSpecializations)->pluck('id')->toArray();

        $lecturers_menu = User::whereHasRoles('lecturer')->hasCourses()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('first_name', 'LIKE', '%' . $this->searchQuery . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $this->searchQuery . '%');
                });
            })
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
            ->when($this->selectedSpecializations, function ($query) use ($selectedSpecializationIds) {
                return $query->whereHas('specializations', function ($subQuery) use ($selectedSpecializationIds) {
                    $subQuery->whereIn('specialization_id', $selectedSpecializationIds);
                });
            })
            ->when($this->selectedNames, function ($query) {
                return $query->where(function ($subQuery) {
                    foreach ($this->selectedNames as $fullName) {
                        $subQuery->orWhereRaw('CONCAT(first_name, " ", last_name) LIKE ?', ["%{$fullName}%"]);
                    }
                });
            })
            // ->when($this->selectedRatings, function ($query) {
            //     // Filter lecturers based on average rating of their courses
            //     return $query->whereHas('courses.reviews', function ($subQuery) {
            //         $subQuery->selectRaw('avg(rating) as average_rating')
            //             ->groupBy('course_id')
            //             ->havingRaw('avg(rating) >= ?', [collect($this->selectedRatings)->avg()]);
            //     });
            // })

            // ->when($this->selectedRatings, function ($query) {
            //     // Filter lecturers based on any of their courses having a rating of 1 or more
            //     return $query->whereHas('courses.reviews', function ($subQuery) {
            //         $subQuery->whereIn('rating', $this->selectedRatings);
            //     });
            // })

            ->when($this->selectedRatings, function ($query) {
                // Filter lecturers based on the average rating of their courses
                foreach ($this->selectedRatings as $rating) {
                    $query->whereHas('courses', function ($subQuery) use ($rating) {
                        $subQuery->whereHas('reviews', function ($reviewQuery) use ($rating) {
                            $reviewQuery->where('rating', '>=', $rating);
                        });
                    });
                }
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

    public function submitSearch()
    {
    }
}
