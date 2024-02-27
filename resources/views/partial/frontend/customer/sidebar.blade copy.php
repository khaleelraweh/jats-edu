<div class="card border-0 rounded-0 p-lg-2 pref" style="padding: 0px">
    <div class="card-body" style="background: #261F23; border-radius: 5px 40px 5px 40px;">
        <h5 class="text-uppercase mb-4">المحتوي</h5>
        <div class=" pref-link {{ Route::currentRouteName() == 'customer.dashboard' ? 'active text-white' : 'p ?>' }}  ">
            <a href="{{ route('customer.dashboard') }}">
                <strong class="small text-uppercase font-weight-bold">لوحة التحكم
                    الرئيسية</strong>
            </a>
        </div>
        <div class=" pref-link {{ Route::currentRouteName() == 'customer.profile' ? 'active text-white' : '' }} ">
            <a href="{{ route('customer.profile') }}">
                <strong class="small text-uppercase font-weight-bold">الملف الشخصي</strong>
            </a>
        </div>
        <div class=" pref-link {{ Route::currentRouteName() == 'customer.addresses' ? 'active text-white' : '' }} ">
            <a href="{{ route('customer.addresses') }}">
                <strong class="small text-uppercase font-weight-bold">العناوين</strong>
            </a>
        </div>
        <div class=" pref-link {{ Route::currentRouteName() == 'customer.orders' ? 'active text-white' : '' }} ">
            <a href="{{ route('customer.orders') }}">
                <strong class="small text-uppercase font-weight-bold">طلباتي</strong>
            </a>
        </div>
        <div class=" pref-link">
            <a href="javascript:void(0);"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <strong class="small text-uppercase font-weight-bold">تسجيل الخروج</strong>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                @csrf
            </form>
        </div>

    </div>
</div>
