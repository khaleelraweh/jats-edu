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
                    <input type="text" class="form-control" placeholder="{{ __('panel.search') }}...">
                    <span class="ri-search-line"></span>
                </div>
            </form>



        </div>

        <div class="d-flex">



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


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="noti-dot"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="ri-shopping-cart-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">Your order is placed</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs"
                                    alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">It will seem like simplified English.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">Your item is shipped</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-xs"
                                    alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
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
                        {{ __('panel.f_profile') }}
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

                    <div class="dropdown-divider"></div>


                    <a class="dropdown-item d-block" href="{{ route('admin.settings.site_main_infos.show') }}">
                        <span class="badge bg-success float-end mt-1 ">11</span>
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        {{ __('panel.site_settings') }}
                    </a>


                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i>
                        {{ __('panel.f_logout') }}</a>
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
