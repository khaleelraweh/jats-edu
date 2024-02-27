@extends('layouts.app')

@section('style')
    <style>
        .pagination>li>a,
        .pagination>li>span {
            background-color: white;
            color: black;
            border-color: white;
        }

        .pagination>li>a:hover,
        .pagination>li>a:focus,
        .pagination>li>span:hover,
        .pagination>li>span:focus {
            background: #dc3c01;
            border-color: #dc3c01;
            color: black;
        }

        .page-item.active .page-link,
        .page-item.active .page-link:hover {
            background: #dc3c01;
            border-color: #dc3c01;
            color: black;
        }

        .page-link:focus {
            box-shadow: 0 0 0 0.2rem #dc3c01;
        }
    </style>
@endsection

@section('content')
    {{-- <div class="container"> --}}

    <div class="page-content">


        <div class="holder breadcrumbs-wrap mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('frontend.index') }}">{{ __('panel.f_main') }}</a></li>
                    <li class="active"><span> {{ __('panel.f_blog') }}</span></li>
                </ul>
            </div>
        </div>



        <div class="holder blog">
            <div class="container">

                <div class="row ">

                    <div class="col-md-4 aside aside--sidebar aside--right aside--sticky js-sticky-collision">
                        <div class="aside-content">


                            @if (count($tags) > 0)
                                <div class="aside-block">
                                    <h2 class="text-uppercase"> {{ __('panel.f_common_tags') }} </h2>
                                    <ul class="tags-list">

                                        @forelse ($tags as $tag)
                                            <li><a
                                                    href="{{ route('frontend.blog_tag', $tag->slug) }}">{{ $tag->name }}</a>
                                            </li>
                                        @empty
                                        @endforelse

                                    </ul>
                                </div>
                            @endif




                            @if (count($random_posts) > 0)
                                <div class="aside-block">
                                    <h2 class="text-uppercase"> {{ __('panel.f_we_chosed_for_you') }} </h2>

                                    @forelse ($random_posts as $rand_post)
                                        <div class="post-prw-simple-sm">
                                            <a href="{{ route('frontend.blog.post', $rand_post->slug) }}"
                                                class="post-prw-img">
                                                <img style="height: 200px"
                                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                    data-src="{{ asset('assets/news/' . $rand_post->firstMedia?->file_name) }}"
                                                    class="lazyload fade-up" alt="{{ $rand_post->title }}">
                                            </a>
                                            <div class="post-prw-links">
                                                <div class="post-prw-date"><i class="icon-calendar"></i>
                                                    {{ $rand_post->published_on->format('Y-F-d') }}
                                                </div>
                                                <a href="{{ route('frontend.blog.post', $rand_post->slug) }}"
                                                    class="post-prw-author">
                                                    {{ $rand_post->created_by ? __('panel.by') . ': ' . $rand_post->created_by : '' }}
                                                </a>
                                            </div>
                                            <h4 class="post-prw-title"><a
                                                    href="{{ route('frontend.blog.post', $rand_post->slug) }}">{{ __('panel.f_topic') }}
                                                    :
                                                    {{ $rand_post->title }}</a>
                                            </h4>


                                        </div>
                                    @empty
                                    @endforelse

                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-md-8 aside aside--content">

                        <div class="post-prws-listing">

                            @forelse ($blog as $post)
                                <div class="post-prw">
                                    <div class="row vert-margin-middle">
                                        <div class="post-prw-img col-md-6">
                                            <a href="{{ route('frontend.blog.post', $post->slug) }}">
                                                <img style="height: 240px"
                                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                    data-src="{{ asset('assets/news/' . $post->firstMedia?->file_name) }}"
                                                    class="lazyload
                                                    fade-up"
                                                    alt="{{ $post->title }}">
                                            </a>
                                        </div>

                                        <div class="post-prw-text col-md-6">
                                            <div class="post-prw-links">
                                                <div class="post-prw-date"><i
                                                        class="icon-calendar"></i>{{ $post->published_on->format('Y - d - F ') }}
                                                </div>
                                                {{-- <div class="post-prw-date"><i class="icon-chat"></i>5 comments</div> --}}
                                            </div>
                                            <h4 class="post-prw-title">
                                                <a href="{{ route('frontend.blog.post', $post->slug) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h4>
                                            <div class="post-prw-teaser">
                                                {!! Str::limit($post->description, 150, ' ...') !!}
                                            </div>
                                            <div class="post-prw-btn">
                                                <a href="{{ route('frontend.blog.post', $post->slug) }}"
                                                    class="btn btn--sm"> {{ __('panel.f_read_more') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                {{ __('panel.f_no_posts_yet') }}
                            @endforelse




                        </div>



                        <!-- PAGINATION-->
                        {!! $blog->appends(request()->all())->onEachSide(3)->links() !!}

                    </div>



                </div>
            </div>
        </div>
    </div>

    {{-- </div> --}}

@endsection
