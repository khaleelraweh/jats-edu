<?php

namespace App\Http\Livewire\Frontend\Courses;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CourseListComponent extends Component
{


    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;

    public $slug;
    public $sortingBy = "default";

    //To filter by categories choosen 
    public $categoryInputs = [];

    // To Filter by level choosen 
    public $courseLevels = [];

    // To filter by price type 
    public $priceInput;

    public $searchQuery = '';
    public $selectedNames = [];

    protected $queryString = ['categoryInputs', 'courseLevels', 'priceInput', 'searchQuery', 'selectedNames'];

    public function resetFilters()
    {
        $this->sortingBy = "default";
        $this->priceInput = '';
        $this->courseLevels = [];
        $this->categoryInputs = [];
    }

    public function render()
    {

        // $lecturers_menu = User::whereHasRoles('lecturer')->hasCourses()
        //     ->orderBy('first_name')
        //     ->orderBy('last_name')
        //     ->when($this->searchQuery, function ($query) {
        //         $query->where(function ($subQuery) {
        //             $subQuery->where('first_name', 'LIKE', '%' . $this->searchQuery . '%')
        //                 ->orWhere('last_name', 'LIKE', '%' . $this->searchQuery . '%');
        //         });
        //     })
        //     ->get()
        //     ->groupBy(function ($user) {
        //         return $user->first_name . ' ' . $user->last_name;
        //     })
        //     ->map(function ($group) {
        //         return $group->count();
        //     });


        // $lecturers_menu = User::whereHasRoles('lecturer')->hasCourses()
        //     ->orderBy('first_name')
        //     ->orderBy('last_name')
        //     ->when($this->searchQuery, function ($query) {
        //         $query->where(function ($subQuery) {
        //             $subQuery->where('first_name', 'LIKE', '%' . $this->searchQuery . '%')
        //                 ->orWhere('last_name', 'LIKE', '%' . $this->searchQuery . '%');
        //         });
        //     })
        //     ->withCount('courses') // Load the count of associated courses for each lecturer
        //     ->get()
        //     ->groupBy(function ($user) {
        //         return $user->first_name . ' ' . $user->last_name;
        //     })
        //     ->map(function ($group) {
        //         // Return the sum of the courses count for each lecturer group
        //         return $group->sum('courses_count');
        //     });


        $lecturers_menu = User::whereHasRoles('lecturer')->hasCourses()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('first_name', 'LIKE', '%' . $this->searchQuery . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $this->searchQuery . '%');
                });
            })
            ->withCount('courses') // Load the count of associated courses for each lecturer
            ->get()
            ->groupBy(function ($user) {
                return $user->first_name . ' ' . $user->last_name;
            })
            ->map(function ($group) {
                // Calculate the count of lecturers in each group
                $lecturersCount = $group->count();
                // Calculate the sum of courses count for each lecturer group
                $coursesCount = $group->sum('courses_count');
                return compact('lecturersCount', 'coursesCount');
            });



        switch ($this->sortingBy) {
            case 'popularity':
                $sort_field = "id";
                $sort_type = "asc";
                break;
            case 'new-courses':
                $sort_field = "created_at";
                $sort_type = "asc";
                break;

            case 'low-high':
                $sort_field = "price";
                $sort_type = "asc";
                break;

            case 'high-low':
                $sort_field = "price";
                $sort_type = "desc";
                break;

            default:
                $sort_field = "id";
                $sort_type = "asc";
        }

        $courses = Course::with('photos', 'firstMedia');
        if ($this->slug == null) {
            $courses = $courses->ActiveCourseCategory();
            if ($this->categoryInputs != null) {
                $courseCategoryIds = CourseCategory::whereIn('slug->' . app()->getLocale(), $this->categoryInputs)->pluck('id')->toArray();
                $courses = $courses->whereIn('course_category_id', $courseCategoryIds);
            }
        } else {

            if ($this->categoryInputs == null) {
                // $courseCategoryIds = CourseCategory::whereIn('slug->' . app()->getLocale(), $this->slug)->pluck('id')->toArray();
                $course_category = CourseCategory::where('slug->' . app()->getLocale(), $this->slug)
                    ->whereStatus(true)
                    ->first();
                $courses = $courses->where('course_category_id', $course_category->id);
            } else {
                $courseCategoryIds = CourseCategory::whereIn('slug->' . app()->getLocale(), $this->categoryInputs)->pluck('id')->toArray();
                $courses = $courses->whereIn('course_category_id', $courseCategoryIds);
            }
        }


        $lecturer_ids = User::when($this->selectedNames, function ($query) {
            return $query->where(function ($subQuery) {
                foreach ($this->selectedNames as $fullName) {
                    $subQuery->orWhereRaw('CONCAT(first_name, " ", last_name) LIKE ?', ["%{$fullName}%"]);
                }
            });
        })->pluck('id')->toArray();


        $courses = $courses->active()
            ->when($this->courseLevels, function ($query) {
                $query->whereIn('skill_level', $this->courseLevels);
            })
            ->when($this->priceInput, function ($query) {
                $query
                    ->when($this->priceInput == 'all', function ($query2) {
                        $query2->where('price', '>=', 0);
                    })
                    ->when($this->priceInput == 'free', function ($query2) {
                        $query2->where('price', '=', 0);
                    })
                    ->when($this->priceInput == 'paid', function ($query2) {
                        $query2->where('price', '>', 0);
                    });
            })


            // ->when($this->selectedNames, function ($query) {
            //     return $query->where(function ($subQuery) {
            //         foreach ($this->selectedNames as $fullName) {
            //             $subQuery->orWhereRaw('CONCAT(first_name, " ", last_name) LIKE ?', ["%{$fullName}%"]);
            //         }
            //     });
            // })

            // ->when($this->selectedNames, function ($query) {
            //     return $query->whereHas('users', function ($subQuery) {
            //         $subQuery->whereIn('user_id', function ($q) {
            //             foreach ($this->selectedNames as $fullName) {
            //                 $q->orWhereRaw('CONCAT(first_name, " ", last_name) LIKE ?', ["%{$fullName}%"])->pluck('id')->toArray();
            //             }
            //         });
            //     });
            // })

            ->when($this->selectedNames, function ($query) use ($lecturer_ids) {
                return $query->whereHas('users', function ($subQuery) use ($lecturer_ids) {
                    $subQuery->whereIn('user_id', $lecturer_ids);
                });
            })


            ->orderBy($sort_field, $sort_type)
            ->paginate($this->paginationLimit);




        $course_categories_menu = CourseCategory::withCount('courses')->has('courses')->get();

        return view('livewire.frontend.courses.course-list-component', [
            'courses'   =>  $courses,
            'course_categories_menu' => $course_categories_menu,
            'sortingBy' => $this->sortingBy,
            'lecturers_menu'    =>  $lecturers_menu,
        ]);
    }
}
