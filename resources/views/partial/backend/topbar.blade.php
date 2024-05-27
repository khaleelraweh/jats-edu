<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin.index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/images/logo-sm.png') }}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="{{ route('admin.index') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/images/logo-sm.png') }}" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/images/logo-light.png') }}" alt="logo-light" height="20">
                    </span>
                </a>
            </div>


            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <a href="{{ route('frontend.index') }}"
                class=" d-flex align-items-center btn btn-sm px-3 font-size-24 header-item waves-effect"
                id="vertical-menu-btn" title="واجهة العملاء">
                <i class="ri-home-wifi-line align-middle  text-success "></i>
            </a>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form>



        </div>

        <div class="d-flex">


            {{-- <div class="dropdown d-inline-block  ms-2">

                <a href="{{ route('frontend.index') }}"
                    class=" d-flex align-items-center btn btn-sm px-3 font-size-24 header-item waves-effect"
                    id="vertical-menu-btn" title="واجهة العملاء">
                    <i class="ri-home-wifi-line"></i>
                </a>

            </div> --}}

            {{-- <div class="dropdown d-inline-block  ms-2">

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle d-flex align-items-center btn btn-sm px-3 font-size-16 header-item waves-effect"
                            id="languagesDropdown" data-toggle="dropdown" role="button" aria-expanded="false"
                            aria-haspopup="true">
                            {{ __('panel.' . config('locales.languages')[app()->getLocale()]['lang']) }}
                            <span class="caret"></span>
                            <i class="mdi mdi-chevron-down"></i>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="languagesDropdown">
                            @foreach (config('locales.languages') as $key => $val)
                                @if ($key != app()->getLocale())
                                    <a href="{{ route('change.language', $key) }}" class="dropdown-item">
                                        {{ __('panel.' . $val['lang']) }}
                                    </a>
                                @endif
                            @endforeach
                        </div>

                    </li>
                </ul>

            </div> --}}



            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                    <img class="" src="{{ asset('backend/images/flags/' . app()->getLocale() . '.webp') }}"
                        alt="{{ __('panel.' . config('locales.languages')[app()->getLocale()]['lang']) }}"
                        height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    @foreach (config('locales.languages') as $key => $val)
                        @if ($key != app()->getLocale())
                            <a href="{{ route('change.language', $key) }}" class="dropdown-item">
                                <img src="{{ asset('backend/images/flags/' . $key . '.webp') }}" alt="user-image"
                                    class="me-1" height="12"> <span
                                    class="align-middle">{{ __('panel.' . $val['lang']) }}</span>
                            </a>
                        @endif
                    @endforeach





                </div>
            </div>



            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>


            @php
                if (auth()->user()->user_image != null) {
                    $user_img = asset('assets/users/' . auth()->user()->user_image);

                    if (!file_exists(public_path('assets/users/' . auth()->user()->user_image))) {
                        $user_img = asset('image/not_found/avator2.webp');
                    }
                } else {
                    $user_img = asset('image/not_found/avator2.webp');
                }
            @endphp

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ $user_img }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ auth()->user()->full_name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.account_settings') }}">
                        <i class="ri-user-line align-middle me-1"></i>
                        Profile
                    </a>

                    @if (auth()->user()->hasRole('instructor'))
                        <a class="dropdown-item" href="{{ route('instructor.dashboard') }}">
                            <i class="ri-user-line align-middle me-1"></i>
                            {{ __('panel.f_instructor_dashboard') }}
                        </a>
                    @else
                        <a class="dropdown-item" href="{{ route('customer.teach_on_jats') }}">
                            <i class="ri-user-line align-middle me-1"></i>
                            {{ __('panel.f_teach_on_jats') }}
                        </a>
                    @endif


                    <a class="dropdown-item d-none" href="#">
                        <i class="ri-wallet-2-line align-middle me-1"></i> My
                        Wallet
                    </a>
                    <a class="dropdown-item d-block" href="{{ route('admin.settings.site_main_infos.show') }}">
                        <span class="badge bg-success float-end mt-1 ">11</span>
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        {{ __('panel.site_settings') }}
                    </a>

                    <a class="dropdown-item" href="#">
                        <i class="ri-lock-unlock-line align-middle me-1"></i>
                        Lock screen
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="ri-settings-2-line"></i>
                </button>
            </div>

        </div>
    </div>
</header>
