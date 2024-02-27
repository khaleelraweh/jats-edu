<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\NewsRequest;
use App\Models\News;
use App\Models\Tag;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;



class NewsController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_news , show_news')) {
            return redirect('admin/index');
        }

        $news = News::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.news.index', compact('news'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_news')) {
            return redirect('admin/index');
        }

        $tags = Tag::whereStatus(1)->where('section', 3)->get(['id', 'name']);

        return view('backend.news.create', compact('tags'));
    }


    public function store(NewsRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_news')) {
            return redirect('admin/index');
        }

        $input['title']              =   $request->title;
        $input['description']       =   $request->description;

        $input['status']            =   $request->status;
        $input['created_by']        =   auth()->user()->full_name;
        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $news = News::create($input);

        $news->tags()->attach($request->tags);

        if ($request->images && count($request->images) > 0) {

            $i = 1;

            foreach ($request->images as $image) {

                $file_name = $news->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/news/' . $file_name);

                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $news->photos()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++;
            }
        }

        if ($news) {
            return redirect()->route('admin.news.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.news.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_news')) {
            return redirect('admin/index');
        }
        return view('backend.news.show');
    }

    public function edit($news)
    {
        if (!auth()->user()->ability('admin', 'update_news')) {
            return redirect('admin/index');
        }

        $news = News::where('id', $news)->first();

        $tags = Tag::whereStatus(1)->where('section', 3)->get(['id', 'name']);

        return view('backend.news.edit', compact('news', 'tags'));
    }

    public function update(NewsRequest $request,  $news)
    {
        if (!auth()->user()->ability('admin', 'update_news')) {
            return redirect('admin/index');
        }

        $news = News::where('id', $news)->first();

        $input['title']              =   $request->title;
        $input['description']       =   $request->description;

        // always added 
        $input['status']            =   $request->status;
        $input['created_by']        =   auth()->user()->full_name;
        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;
        // end of always added 

        $news->update($input);

        $news->tags()->sync($request->tags);

        if ($request->images && count($request->images) > 0) {
            $i = $news->photos->count() + 1;

            foreach ($request->images as $image) {

                $file_name = $news->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/news/' . $file_name);

                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $news->photos()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++;
            }
        }


        if ($news) {
            return redirect()->route('admin.news.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.news.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function destroy($news)
    {
        if (!auth()->user()->ability('admin', 'delete_news')) {
            return redirect('admin/index');
        }

        $news = News::where('id', $news)->first();

        if ($news->photos->count() > 0) {
            foreach ($news->photos as $photo) {
                if (File::exists('assets/news/' . $photo->file_name)) {
                    unlink('assets/news/' . $photo->file_name);
                }
                $photo->delete();
            }
        }

        $news->delete();

        if ($news) {
            return redirect()->route('admin.news.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.news.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function remove_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_news')) {
            return redirect('admin/index');
        }

        //find product from product table 
        $news = News::findOrFail($request->new_id);

        //find photos image from photos table 
        $image = $news->photos()->where('id', $request->image_id)->first();

        if (File::exists('assets/news/' . $image->file_name)) {
            unlink('assets/news/' . $image->file_name);
        }
        $image->delete();

        return true;
    }
}
