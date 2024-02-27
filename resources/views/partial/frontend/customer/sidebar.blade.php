<div class="card mt-0 border-0  p-lg-2 custom-card main-back-color" style="padding: 0px">
    <div class="card-body custom-card-body-rounded second-back-color">
        <h5 class="text-uppercase mb-4">{{ __('panel.f_content') }}</h5>
        <div
            class="custom-nav-item {{ Route::currentRouteName() == 'customer.dashboard' ? 'active text-white' : 'p ?>' }}  ">
            <a href="{{ route('customer.dashboard') }}">
                <strong class="small text-uppercase font-weight-bold">
                    {{ __('panel.f_control_panel') }}
                </strong>
            </a>
        </div>
        <div class=" custom-nav-item {{ Route::currentRouteName() == 'customer.profile' ? 'active text-white' : '' }} ">
            <a href="{{ route('customer.profile') }}">
                <strong class="small text-uppercase font-weight-bold">{{ __('panel.f_profile') }}</strong>
            </a>
        </div>
        <div
            class=" custom-nav-item {{ Route::currentRouteName() == 'customer.addresses' ? 'active text-white' : '' }} ">
            <a href="{{ route('customer.addresses') }}">
                <strong class="small text-uppercase font-weight-bold">{{ __('panel.f_user_addresses') }}</strong>
            </a>
        </div>
        <div class=" custom-nav-item {{ Route::currentRouteName() == 'customer.orders' ? 'active text-white' : '' }} ">
            <a href="{{ route('customer.orders') }}">
                <strong class="small text-uppercase font-weight-bold">{{ __('panel.f_my_orders') }}</strong>
            </a>
        </div>
        <div class=" custom-nav-item">
            <a href="javascript:void(0);"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <strong class="small text-uppercase font-weight-bold">{{ __('panel.f_logout') }}</strong>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                @csrf
            </form>
        </div>

    </div>
</div>
