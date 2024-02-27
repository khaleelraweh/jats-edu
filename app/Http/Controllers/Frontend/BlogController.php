<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\SiteSetting;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class BlogController extends Controller
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 4;
    public $slug;

    public function blog()
    {

        $blog = News::query()
            ->active()
            ->paginate($this->paginationLimit);

        $tags = Tag::query()->whereStatus(1)->where('section', 3)->get();

        $random_posts = News::with('tags')
            ->active()
            ->inRandomOrder()
            ->take(2)
            ->get();

        return view('frontend.blog.blog', compact('blog', 'tags', 'random_posts'));
    }

    public function blog_tag($slug = null)
    {

        $tags = Tag::query()->whereStatus(1)->where('section', 3)->get();

        $random_posts = News::with('tags')
            ->active()
            ->inRandomOrder()
            ->take(2)
            ->get();

        $blog = News::query();

        $blog = $blog->with('tags')->whereHas('tags', function ($query) use ($slug) {
            $query->where([
                'slug->' . app()->getLocale() => $slug,
                'status' => true
            ]);
        });

        $blog = $blog->active()
            //  ->orderBy($sort_field , $sort_type)
            ->paginate($this->paginationLimit);



        return view('frontend.blog.blog_tag', compact('slug', 'blog', 'tags', 'random_posts'));
    }


    public function post($slug): View
    {

        $post  = News::with('tags')
            ->where('slug->' . app()->getLocale(), $slug)
            ->Active()
            ->firstOrFail();

        $tags = Tag::query()->whereStatus(1)->where('section', 3)->get();

        // dd($tags);

        $related_posts = News::query()
            ->active()
            ->take(
                SiteSetting::whereNotNull('value')
                    ->pluck('value', 'name')
                    ->toArray()['site_posts']
            )
            ->get();



        $random_posts = News::with('tags')
            ->active()
            ->inRandomOrder()
            ->take(2)
            ->get();
        return view('frontend.blog.blog_post', compact('post', 'related_posts', 'tags', 'random_posts'));
    }
}
