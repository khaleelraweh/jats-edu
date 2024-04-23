<?php

namespace App\Http\Livewire\Frontend\EventList;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Post;
use Livewire\Component;

class EventListComponent extends Component
{

    public  $amount = 6;
    public $events;
    public $showMoreBtn = false;
    public $showLessBtn = false;

    // filtering 
    public $categoryInputs;
    public $sortingBy;
    public $searchQuery = '';
    protected $queryString = ['categoryInputs', 'sortingBy', 'searchQuery'];


    public function render()
    {
        $categories_menu = CourseCategory::withCount('courses')->get();
        // $this->events = Post::with('photos', 'topics', 'requirements')
        $this->events = Course::with('photos', 'topics', 'requirements')
            ->Course()
            ->when($this->categoryInputs, function ($query) {
                $query->where('course_category_id', $this->categoryInputs);
            })
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('title', 'LIKE', '%' . $this->searchQuery . '%');
                });
            })
            ->when($this->sortingBy, function ($query) {
                $query
                    ->when($this->sortingBy == 'default', function ($query2) {
                        $query2->orderBy('id', 'ASC');
                    })

                    ->when($this->sortingBy == 'new-events', function ($query2) {
                        $query2->orderBy('created_at', 'ASC');
                    })
                    ->when($this->sortingBy == 'new-old', function ($query2) {
                        $query2->orderBy('created_at', 'ASC');
                    })
                    ->when($this->sortingBy == 'old-new', function ($query2) {
                        $query2->orderBy('created_at', 'DESC');
                    });
            })

            ->get();

        if (count($this->events) > 6) {
            $this->showMoreBtn = true;
            if ($this->amount > 6) {
                if (count($this->events) <= $this->amount) {
                    $this->showLessBtn = true;
                    $this->showMoreBtn = false;
                } else {
                    $this->showLessBtn = true;
                }
            } else {
                $this->showLessBtn = false;
            }
        } else {
            $this->showMoreBtn = false;
        }


        return view('livewire.frontend.event-list.event-list-component', [
            'events' => $this->events,
            'categories_menu'    =>  $categories_menu
        ]);
    }

    public function load_more()
    {
        $this->amount += 3;
    }

    public function load_less()
    {
        $this->amount = 6;
    }
}
