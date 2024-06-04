<header
    class="navbar navbar-expand-xl {{ !request()->routeIs('frontend.index') ? 'navbar-light bg-white border-bottom py-2 py-xl-4' : 'navbar-dark' }} ">
    <div class="container-fluid">

        {{-- @php
            $web_menus = App\Models\WebMenu::tree();
        @endphp --}}

        <!-- Brand -->
        <a class="navbar-brand me-0" href="{{ route('frontend.index') }}">
            <img src="{{ asset('frontend/assets/img/brand.svg') }}" class="navbar-brand-img" alt="...">
        </a>

        <!-- Vertical Menu -->
        {{-- <ul class="navbar-nav navbar-vertical ms-xl-4 d-none d-xl-flex"> --}}
        <ul class="navbar-nav navbar-vertical ms-xl-4 d-none ">
            <li class="nav-item dropdown">
                <a class="nav-link pb-4 mb-n4 px-0 pt-0" id="navbarVerticalMenu" data-bs-toggle="dropdown" href="#"
                    aria-haspopup="true" aria-expanded="false">
                    <div
                        class="  {{ !request()->routeIs('frontend.index') ? 'bg-primary' : 'bg-white' }} rounded py-3 px-5 d-flex align-items-center">
                        <div
                            class="me-3 ms-1 d-flex {{ !request()->routeIs('frontend.index') ? 'text-white' : 'text-primary' }}">
                            <!-- Icon -->
                            <svg width="25" height="17" viewBox="0 0 25 17" xmlns="http://www.w3.org/2000/svg">
                                <rect width="25" height="1" fill="currentColor" />
                                <rect y="8" width="15" height="1" fill="currentColor" />
                                <rect y="16" width="20" height="1" fill="currentColor" />
                            </svg>

                        </div>
                        <span
                            class="{{ !request()->routeIs('frontend.index') ? 'text-white' : 'text-primary' }} fw-medium me-1 text-uppercase">{{ __('transf.courses') }}</span>
                    </div>
                </a>


                <ul class="dropdown-menu dropdown-menu-md {{ !request()->routeIs('frontend.index') ? 'bg-primary' : 'bg-white' }} rounded py-4 mt-4 "
                    aria-labelledby="navbarVerticalMenu">

                    @foreach ($web_menus->where('section', 1) as $menu)
                        @if (count($menu->appearedChildren) == false)
                            <li class="dropdown-item dropright">
                                <a href="{{ $menu->link }}">
                                    <div class="me-4 d-flex {{ !request()->routeIs('frontend.index') ? 'text-white' : 'text-primary' }} icon-xs"
                                        style="display: inline-block !important">
                                        <!-- Icon -->
                                        <i class="{{ $menu->icon }}"></i>
                                    </div>
                                    {{ $menu->title }}

                                </a>
                            </li>
                        @else
                            <li class="dropdown-item dropright">
                                <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown"
                                    href="{{ $menu->link }}">
                                    <div
                                        class="me-4 d-flex {{ !request()->routeIs('frontend.index') ? 'text-white' : 'text-primary' }} icon-xs">
                                        <!-- Icon -->
                                        <i class="{{ $menu->icon }}"></i>

                                    </div>
                                    {{ $menu->title }}
                                </a>

                                <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                    <div
                                        class="dropdown-menu-md {{ !request()->routeIs('frontend.index') ? 'bg-primary' : 'bg-white' }} rounded dropdown-menu-inner">
                                        @if ($menu->appearedChildren !== null && count($menu->appearedChildren) > 0)
                                            @foreach ($menu->appearedChildren as $sub_menu)
                                                <a class="dropdown-item" href="{{ $sub_menu->link }}">
                                                    {{ $sub_menu->title }}
                                                </a>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>

                            </li>
                        @endif
                    @endforeach

                </ul>
            </li>
        </ul>

        <!-- Search -->
        <form class="d-none d-wd-flex ms-5 w-xl-450p">
            <div class="input-group border rounded">
                <div class="input-group-prepend">
                    <button class="btn btn-sm my-2 my-sm-0 text-white icon-xs d-flex align-items-center" type="submit">
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

                <input
                    class="form-control form-control-sm border-0 ps-0 {{ !request()->routeIs('frontend.index') ? '' : 'placeholder-white text-white bg-transparent' }}"
                    type="search" placeholder="{{ __('transf.txt_what_do_you_want_to_learn?') }}" aria-label="Search">
            </div>
        </form>

        <!-- Collapse -->
        <div class=" collapse navbar-collapse z-index-lg" id="navbarCollapse">

            <!-- Toggler -->
            <button class="navbar-toggler outline-0 text-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <!-- Icon -->
                <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                        fill="currentColor"></path>
                    <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                        fill="currentColor"></path>
                </svg>

            </button>


            <!-- Navigation -->
            <ul class="navbar-nav ms-auto">

                @foreach ($web_menus->where('section', 1) as $menu)
                    @if (count($menu->appearedChildren) == false)
                        <li class="">
                            <a class="nav-link dropdown px-xl-4 text-uppercase" id="navbarShop"
                                href="{{ $menu->link }}" aria-haspopup="true" aria-expanded="false">
                                {{ $menu->title }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle px-xl-4 text-uppercase" id="navbarBlog"
                                data-bs-toggle="dropdown" href="{{ $menu->link }}" aria-haspopup="true"
                                aria-expanded="false">
                                {{ $menu->title }}
                            </a>
                            @if ($menu->appearedChildren !== null && count($menu->appearedChildren) > 0)
                                <ul class="dropdown-menu border-xl shadow-none" aria-labelledby="navbarBlog">
                                    @foreach ($menu->appearedChildren as $sub_menu)
                                        @if (count($sub_menu->appearedChildren) == false)
                                            <li class="dropdown-item">
                                                <a class="dropdown-link" href="{{ $sub_menu->link }}">
                                                    {{ $sub_menu->title }}
                                                </a>
                                            </li>
                                        @else
                                            <li class="dropdown-item dropright">
                                                <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown"
                                                    href="{{ $sub_menu->link }}">
                                                    {{ $sub_menu->title }}
                                                </a>
                                                @if ($sub_menu->appearedChildren !== null && count($sub_menu->appearedChildren) > 0)
                                                    <div class="dropdown-menu border-xl shadow-none">
                                                        @foreach ($sub_menu->appearedChildren as $sub_menu_2)
                                                            <a class="dropdown-item" href="{{ $sub_menu_2->link }}">
                                                                {{ $sub_menu_2->title }}
                                                            </a>
                                                        @endforeach

                                                    </div>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>

        <!-- Search, Account & Cart -->
        <ul class="navbar-nav flex-row ms-auto ms-xl-0 me-n2 me-md-n4">
            <li class="nav-item border-0 px-0 d-none d-370-block d-xl-none">
                <a class="nav-link d-flex px-3 px-md-4 search-mobile {{ !request()->routeIs('frontend.index') ? 'text-secondary' : 'text-white-all' }}   icon-xs"
                    data-bs-toggle="collapse" href="#collapseSearchMobile" role="button" aria-expanded="false"
                    aria-controls="collapseSearchMobile">
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


                    <!-- Icon -->
                    <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                            fill="currentColor"></path>
                        <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                            fill="currentColor"></path>
                    </svg>

                </a>

                <div class="collapse position-absolute right-0 left-0 mx-4" id="collapseSearchMobile">
                    <div class="card card-body p-4 mt-7 shadow-dark">
                        <!-- Search -->
                        <form class="w-100">
                            <div class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm text-secondary icon-xs d-flex align-items-center"
                                        type="submit">
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
                                <input class="form-control form-control-sm border-0 ps-0" type="search"
                                    placeholder="{{ __('transf.txt_what_do_you_want_to_learn?') }}"
                                    aria-label="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </li>

            <li class="nav-item border-0 px-0">
                <!-- Button trigger account modal -->
                @livewire('frontend.header.account-notifications-count-component')
            </li>

            <li class="nav-item border-0 px-0">
                <!-- Button trigger cart modal -->
                @livewire('frontend.header.cart-counts-component')
            </li>
        </ul>

        <!-- Toggler -->
        <button
            class="navbar-toggler ms-4 ms-md-5 shadow-none bg-teal text-white icon-xs p-0 outline-0 h-40p w-40p d-flex d-xl-none place-flex-center"
            type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <!-- Icon -->
            <svg width="25" height="17" viewBox="0 0 25 17" xmlns="http://www.w3.org/2000/svg">
                <rect width="25" height="1" fill="currentColor" />
                <rect y="8" width="15" height="1" fill="currentColor" />
                <rect y="16" width="20" height="1" fill="currentColor" />
            </svg>

        </button>
    </div>
</header>
