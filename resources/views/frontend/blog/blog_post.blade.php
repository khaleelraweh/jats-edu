@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-content">

            <div class="holder breadcrumbs-wrap mt-0">
                <div class="container">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('frontend.index') }}">{{ __('panel.f_main') }}</a></li>
                        <li><a href="{{ route('frontend.blog') }}">{{ __('panel.f_blog') }}</a></li>
                        <li class="active"><span> {{ $post->title }}<span></li>
                    </ul>
                </div>
            </div>

            <div class="holder blog">
                <div class="container">

                    <div class="row flex-column-reverse flex-md-row">

                        <div class="col-md-4 aside aside--sidebar aside--right">

                            @if (count($tags) > 0)
                                <div class="aside-block">
                                    <h2 class="text-uppercase"> {{ __('panel.f_common_tags') }} </h2>
                                    <ul class="tags-list">

                                        @foreach ($tags as $tag)
                                            <li><a
                                                    href="{{ route('frontend.blog_tag', $tag->slug) }}">{{ $tag->name }}</a>
                                            </li>
                                        @endforeach

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
                                                    {{ $rand_post->title }}
                                                </a></h4>
                                            {{-- <a href="#" class="post-prw-comments"><i class="icon-chat"></i>15
                                                comments</a> --}}
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            @endif

                        </div>

                        <div class="col-md-8 aside aside--content">
                            <div class="post-full">
                                <h2 class="post-title">{{ $post->title }}</h2>
                                <div class="post-links">
                                    <div class="post-date"><i
                                            class="icon-calendar"></i>{{ $post->published_on->format('Y-m-d') }}</div>
                                    <a href="#" class="post-link">
                                        {{ $post->created_by ? __('panel.by') . ': ' . $post->created_by : '' }}</a>
                                    {{-- <a href="#postComments" class="js-scroll-to"><i class="icon-chat"></i>15
                                        تعليق(ات)</a> --}}
                                </div>
                                <div class="post-img image-container" style="padding-bottom: 60.95%">
                                    <img class="lazyload fade-up-fast"
                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                        data-src="{{ asset('assets/news/' . $post->firstMedia?->file_name) }}"
                                        alt="{{ $post->title }}">
                                </div>
                                <div class="post-text">

                                    {!! $post->description !!}

                                </div>
                                <div class="post-bot">

                                    <ul class="tags-list post-tags-list">
                                        @foreach ($post->tags as $tag)
                                            <li><a
                                                    href="{{ route('frontend.blog_tag', $tag->slug) }}">{{ $tag->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('frontend.blog_tag', $tag->slug) }}" class="post-share">
                                        <script src="../../../https@s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d92f2937e44d337"></script>
                                        <div class="addthis_inline_share_toolbox"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="related-posts">
                                <div class="title-with-arrows">
                                    <h3 class="h2-style">
                                        {{ __('panel.f_posts_related_to_this_topic') }}
                                    </h3>
                                    <div class="carousel-arrows"></div>
                                </div>

                                {{-- <div class="post-prws post-prws-carousel js-post-prws-carousel"
                                    data-slick='{"slidesToShow": 1, "responsive": [{"breakpoint": 1024,"settings": {"slidesToShow": 1}},{"breakpoint": 768,"settings": {"slidesToShow": 1}},{"breakpoint": 480,"settings": {"slidesToShow": 1}}]}'> --}}

                                <div class="post-prws post-prws-carousel post-prws-carousel--single js-post-prws-carousel"
                                    data-slick='{"slidesToShow": 1, "responsive": [{"breakpoint": 1200,"settings": {"slidesToShow": 1}},{"breakpoint": 768,"settings": {"slidesToShow": 1}},{"breakpoint": 480,"settings": {"slidesToShow": 1}}]}'>

                                    @forelse ($related_posts as $related_post)
                                        <div class="post-prw">
                                            <div class="row vert-margin-middle">

                                                <div class="post-prw-img col-sm-6">
                                                    <a href="{{ route('frontend.blog.post', $related_post->slug) }}"
                                                        class="d-block image-container" style="padding-bottom: 88.92%">
                                                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                            data-src="{{ asset('assets/news/' . $related_post->firstMedia?->file_name) }}"
                                                            class="lazyload fade-up" alt="Blog Title" />
                                                    </a>
                                                </div>

                                                <div class="post-prw-text col-sm-6">
                                                    <h4 class="post-prw-title">
                                                        <a href="{{ route('frontend.blog.post', $related_post->slug) }}">
                                                            {{ $related_post->title }} </a>
                                                    </h4>
                                                    <div class="post-prw-links">
                                                        <div class="post-prw-date">
                                                            <i
                                                                class="icon-calendar1"></i><span>{{ $related_post->published_on }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="post-prw-teaser">
                                                        {{-- {!! $related_post->description !!} --}}
                                                        {!! Str::limit($post->description, 150, ' ...') !!}
                                                    </div>
                                                    <div class="post-prw-btn">
                                                        <a href="#" class="btn btn--md">
                                                            {{ __('panel.f_read_more') }} </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                    @endforelse

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
