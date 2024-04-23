@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_blogs') }}
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a>
                        @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')
                            <i class="fa fa-solid fa-chevron-left chevron"></i>
                        @else
                            <i class="fa fa-solid fa-chevron-right chevron"></i>
                        @endif
                    </li>
                    <li>
                        {{ __('panel.show_posts') }}
                    </li>
                </ul>
            </div>

            <div class="ml-auto">
                @ability('admin', 'create_posts')
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        {{ __('panel.add_new_post') }}
                    </a>
                @endability
            </div>

        </div>

        <div class="card-body">
            {{-- filter form part  --}}
            @include('backend.posts.filter.filter')

            {{-- table part --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ __('panel.image') }}</th>
                            <th>{{ __('panel.title') }}</th>
                            <th>{{ __('panel.author') }}</th>
                            <th>{{ __('panel.status') }}</th>
                            <th class="d-none d-sm-table-cell"> {{ __('panel.description') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('panel.created_at') }}</th>
                            <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($posts as $post)
                            <tr>
                                <td>

                                    @php
                                        if (
                                            $post->photos->first() != null &&
                                            $post->photos->first()->file_name != null
                                        ) {
                                            $post_img = asset('assets/posts/' . $post->photos->first()->file_name);

                                            if (
                                                !file_exists(
                                                    public_path('assets/posts/' . $post->photos->first()->file_name),
                                                )
                                            ) {
                                                $post_img = asset('image/not_found/item_image_not_found.webp');
                                            }
                                        } else {
                                            $post_img = asset('image/not_found/item_image_not_found.webp');
                                        }
                                    @endphp
                                    <img src="{{ $post_img }}" width="60" height="60"
                                        alt="{{ $post->name }}">


                                </td>
                                <td>
                                    {{ Str::limit($post->title, 50) }}
                                </td>
                                <td>{{ $post->created_by }}</td>
                                <td>{{ $post->status() }}</td>
                                <td class="d-none d-sm-table-cell">{!! Str::limit($post->description, 50, ' ...') !!}</td>
                                <td class="d-none d-sm-table-cell">{{ $post->published_on->format('Y-m-d h:i a') ?? '-' }}
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);"
                                            onclick=" if( confirm('{{ __('panel.confirm_delete_message') }}') ){document.getElementById('delete-post-{{ $post->id }}').submit();}else{return false;}"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post"
                                        class="d-none" id="delete-post-{{ $post->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">{{ __('panel.no_found_item') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="float-right">
                                    {!! $posts->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection
