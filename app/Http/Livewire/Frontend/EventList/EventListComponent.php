<?php

namespace App\Http\Livewire\Frontend\EventList;

use App\Models\Post;
use Livewire\Component;

class EventListComponent extends Component
{

    public  $amount = 6;
    public $posts;
    public $showMoreBtn = false;
    public $showLessBtn = false;


    public function render()
    {
        $this->posts = Post::with('photos', 'topics', 'requirements')->get();

        if (count($this->posts) > 6) {
            $this->showMoreBtn = true;
            if ($this->amount > 6) {
                if (count($this->posts) <= $this->amount) {
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
            'posts' => $this->posts,
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
