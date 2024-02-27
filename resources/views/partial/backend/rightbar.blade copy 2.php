<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>


        <span class="navbar-text">
            <form action="{{ route('admin.create_update_theme') }}" method="post" class="d-flex">
                @csrf
                <input type="radio" name="theme_choice" id="theme"
                    value="{{ Cookie::get('theme') == 'dark' ? 'light' : 'dark' }}" class="btn-check"
                    onchange="this.form.submit();">
                <label for="theme" class="btn btn-secondary">
                    <i class="{{ Cookie::get('theme') == 'light' ? 'fas fa-moon' : 'fas fa-sun text-warning' }}"></i>
                    Mode
                </label>
            </form>
        </span>

        <div class="p-4">
            <div class="mb-2">
                <label for="light-mode-switch" class="form-check-label">
                    <img src="{{ asset('backend/images/layouts/layout-1.jpg') }}" class="img-fluid img-thumbnail"
                        alt="layout-1">
                </label>
            </div>

            <div class="form-check form-switch mb-3">
                <form action="{{ route('admin.create_update_theme') }}" method="post">
                    @csrf
                    <input class="form-check-input theme-choice" name="theme_choice" value="light" type="checkbox"
                        id="light-mode-switch" onchange="this.form.submit();"
                        {{ Cookie::get('theme') == 'light' ? 'checked , disabled' : '' }}>

                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </form>
            </div>


            <div class="mb-2">
                <label for="dark-mode-switch" class="form-check-label">
                    <img src="{{ asset('backend/images/layouts/layout-2.jpg') }}" class="img-fluid img-thumbnail"
                        alt="layout-2">
                </label>
            </div>



            <div class="form-check form-switch mb-3">
                <form action="{{ route('admin.create_update_theme') }}" method="post">
                    @csrf
                    <input class="form-check-input theme-choice" name="theme_choice" value="dark" type="checkbox"
                        id="dark-mode-switch" onchange="this.form.submit();"
                        {{ Cookie::get('theme') == 'dark' ? 'checked , disabled' : '' }}>
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </form>
            </div>



            <div class="mb-2">
                <label for="rtl-mode-switch" class="form-check-label">
                    <img src="{{ asset('backend/images/layouts/layout-3.jpg') }}" class="img-fluid img-thumbnail"
                        alt="layout-3">
                </label>
            </div>

            {{-- <div class="form-check form-switch mb-5">
                <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch"
                    data-appStyle="{{ asset('backend/css/app-rtl.min.css') }}" checked>
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div> --}}

            <div class="form-check form-switch mb-5">
                <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch"
                    data-appStyle="{{ asset('backend/css/app-rtl.min.css') }}" checked disabled>
                <label class="form-check-label" for="rtl-mode-switch">
                    <div class="dropdown d-inline-block  ms-2">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle  p-0" id="languagesDropdown"
                                    data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ __('panel.' . config('locales.languages')[app()->getLocale()]['lang']) }}
                                    <span class="caret"></span>
                                    <i class="mdi mdi-chevron-down"></i>
                                </a>
                                <div class="dropdown-menu position-relative" style=""
                                    aria-labelledby="languagesDropdown">
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

                    </div>
                </label>
            </div>



        </div>

    </div> <!-- end slimscroll-menu-->
</div>
