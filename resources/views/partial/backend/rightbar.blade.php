<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">{{ __('panel.settings') }}</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">{{ __('panel.choose_layouts') }}</h6>


        {{-- will be used in frontend index  --}}
        <span class="navbar-text ">
            <form action="{{ route('admin.create_update_theme') }}" method="post" class="d-flex">
                @csrf
                <input type="radio" name="theme_choice" id="theme"
                    value=" {{ Cookie::get('theme') != null ? (Cookie::get('theme') == 'dark' ? 'light' : 'dark') : 'light' }}"
                    class="btn-check" onchange="this.form.submit();">
                <label for="theme" class="btn btn-secondary">
                    <i class="{{ Cookie::get('theme') == 'light' ? 'fas fa-moon' : 'fas fa-sun text-warning' }}"></i>
                    {{ __('panel.mode') }}
                </label>
            </form>
        </span>

        <div class="p-4 pt-3">
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

                    <label class="form-check-label" for="light-mode-switch"> {{ __('panel.light_mode') }} </label>
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
                        {{ Cookie::get('theme') != null ? (Cookie::get('theme') == 'dark' ? 'checked , disabled' : '') : 'checked , disabled' }}>
                    <label class="form-check-label" for="dark-mode-switch">{{ __('panel.dark_mode') }} </label>
                </form>
            </div>

            @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')
                <div class="mb-2">
                    <label for="rtl-mode-switch" class="form-check-label">
                        <img src="{{ asset('backend/images/layouts/layout-1.jpg') }}" class="img-fluid img-thumbnail"
                            alt="layout-3">
                    </label>
                </div>
            @else
                <div class="mb-2">
                    <label for="rtl-mode-switch" class="form-check-label">
                        <img src="{{ asset('backend/images/layouts/layout-3.jpg') }}" class="img-fluid img-thumbnail"
                            alt="layout-3">
                    </label>
                </div>
            @endif


            <div class="form-check form-switch mb-3">
                @foreach (config('locales.languages') as $key => $val)
                    @if ($key != app()->getLocale())
                        <form action="{{ route('change.language', $key) }}" method="get">
                            @csrf
                            <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch"
                                onchange="this.form.submit();">
                            <label class="form-check-label" for="dark-mode-switch">
                                {{ __('panel.' . $val['lang']) }}
                            </label>

                        </form>
                    @endif
                @endforeach
            </div>





        </div>

    </div> <!-- end slimscroll-menu-->
</div>
