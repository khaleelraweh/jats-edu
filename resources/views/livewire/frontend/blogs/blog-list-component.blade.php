<div>
    <!-- BLOG LIST V1 -->
    <div class="container mb-11">


        <div class="row">
            <div class="col-md-7 col-lg-8 col-xl-9 mb-5 mb-md-0">
                <!-- Blog Post -->
                @foreach ($posts as $post)
                    <div class="row mb-6 align-items-center">
                        <div class="col-lg-6 col-xl-5 mb-6 mb-lg-0">
                            <a href="{{ route('frontend.blog_single', 1) }}"
                                class="d-block sk-thumbnail img-ratio-4 rounded lift">
                                @php
                                    if ($post->photos->first() != null && $post->photos->first()->file_name != null) {
                                        $post_img = asset('assets/posts/' . $post->photos->first()->file_name);

                                        if (
                                            !file_exists(
                                                public_path('assets/posts/' . $post->photos->first()->file_name),
                                            )
                                        ) {
                                            $post_img = asset('assets/posts/no_image_found.webp');
                                        }
                                    } else {
                                        $post_img = asset('assets/posts/no_image_found.webp');
                                    }
                                @endphp
                                <img src="{{ $post_img }}" alt="{{ $post->title }}" class="rounded img-fluid">
                            </a>
                        </div>

                        <div class="col-lg-6 col-xl-7">
                            <a href="{{ route('frontend.blog_single', $post->slug) }}" class="d-inline-block">
                                <h5 class="text-blue">{{ $post->courseCategory->title }}</h5>
                            </a>

                            <a href="{{ route('frontend.blog_single', 1) }}" class="d-block me-xl-12">
                                <h3 class="">
                                    {{ $post->title }}
                                </h3>
                            </a>

                            <p class="line-clamp-3 mb-6 mb-xl-8 me-xl-6">
                                {{ $post->description }}
                            </p>

                            <div class="d-md-flex align-items-center">
                                <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-4">
                                    <div class="p-1">
                                        <img src="{{ asset('frontend/assets/img/avatars/avatar-1.jpg') }}"
                                            alt="..." class="rounded-circle" width="52" height="52">
                                    </div>
                                </div>

                                <div class="mb-4 mb-md-0">
                                    <a href="{{ route('frontend.blog_single', 1) }}" class="d-block">
                                        <h6 class="mb-0">Alison Dawn</h6>
                                    </a>
                                    <span class="font-size-sm">April 06, 2020</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- PAGINATION
                                     -->
                <nav class="mt-8" aria-label="Page navigationa">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

            <div class="col-md-5 col-lg-4 col-xl-3">
                <!-- BLOG SIDEBAR -->
                <div class="">
                    <div class="border rounded mb-6">
                        <div class="input-group">
                            <input class="form-control form-control-sm border-0 pe-0" type="search"
                                placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sm my-2 my-sm-0 text-secondary icon-uxs" type="submit">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z"
                                            fill="currentColor" />
                                        <path
                                            d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z"
                                            fill="currentColor" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded mb-6 p-5 py-md-6 ps-md-6 pe-md-4">
                        <h4 class="mb-5">Category</h4>
                        <div class="nav flex-column nav-vertical">
                            <a href="blog-grid-v2.html" class="nav-link py-2">Art (8)</a>
                            <a href="blog-grid-v2.html" class="nav-link py-2 active">Exercise (8)</a>
                            <a href="blog-grid-v2.html" class="nav-link py-2">Material Design (7)</a>
                            <a href="blog-grid-v2.html" class="nav-link py-2">Software Development (6)</a>
                            <a href="blog-grid-v2.html" class="nav-link py-2">Music (6)</a>
                            <a href="blog-grid-v2.html" class="nav-link py-2">Photography (6)</a>
                        </div>
                    </div>

                    <div class="border rounded mb-6 p-5 py-md-6 ps-md-6 pe-md-4">
                        <h4 class="mb-5">Recent Posts</h4>
                        <ul class="list-unstyled mb-0">
                            <li class="media mb-6 d-flex">
                                <a href="{{ route('frontend.blog_single', 1) }}" class="mw-70p d-block me-5">
                                    <img src="{{ asset('frontend/assets/img/photos/photo-1.jpg') }}" alt="..."
                                        class="avatar-img rounded-lg h-70p o-f-c">
                                </a>
                                <div class="media-body flex-shrink-1">
                                    <a href="{{ route('frontend.blog_single', 1) }}" class="d-block">
                                        <h6 class="line-clamp-2 mb-1 fw-normal">Web Development Design</h6>
                                    </a>
                                    <span>April 06, 2020</span>
                                </div>
                            </li>

                            <li class="media mb-6 d-flex">
                                <a href="{{ route('frontend.blog_single', 1) }}" class="mw-70p d-block me-5">
                                    <img src="{{ asset('frontend/assets/img/photos/photo-2.jpg') }}" alt="..."
                                        class="avatar-img rounded-lg h-70p o-f-c">
                                </a>
                                <div class="media-body flex-shrink-1">
                                    <a href="{{ route('frontend.blog_single', 1) }}" class="d-block">
                                        <h6 class="line-clamp-2 mb-1 fw-normal">The Complete Security Course</h6>
                                    </a>
                                    <span>April 06, 2020</span>
                                </div>
                            </li>

                            <li class="media mb-0 d-flex">
                                <a href="{{ route('frontend.blog_single', 1) }}" class="mw-70p d-block me-5">
                                    <img src="{{ asset('frontend/assets/img/photos/photo-14.jpg') }}" alt="..."
                                        class="avatar-img rounded-lg h-70p o-f-c">
                                </a>
                                <div class="media-body flex-shrink-1">
                                    <a href="{{ route('frontend.blog_single', 1) }}" class="d-block">
                                        <h6 class="line-clamp-2 mb-1 fw-normal">Fashion Photography</h6>
                                    </a>
                                    <span>April 06, 2020</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="border rounded mb-6 p-5 py-md-6 ps-md-6 pe-md-4">
                        <h4 class="mb-5">Tags</h4>
                        <a href="blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Course</a>
                        <a href="blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Timeline</a>
                        <a href="blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Moodle</a>
                        <a href="blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Best</a>
                        <a href="blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Info</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
