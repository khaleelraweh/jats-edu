@extends('layouts.app')

@section('content')
    <section class="py-5 pref">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ __('تاكيد عنوان البريد الإلكتروني') }}</h1>
                </div>
                <div class="col-lg-6 text-lg-end">

                </div>
            </div>
        </div>
    </section>

    <section class="py-5 ">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="h5 text-uppercase mb-3">{{ __('تاكيد عنوان البريد الإلكتروني') }}</h2>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert"
                        style="margin-bottom: 5px ; background-color:rgba(200 , 100 , 100,0.3) ; border-radius: 10px">
                        {{ __('تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.') }}
                    </div>
                @endif
                {{ __('قبل المتابعة، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التحقق.') }}
                {{ __('إذا لم تتلق البريد الإلكتروني') }},

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 px-1 py-1 m-0 align-baseline"
                        style="border-radius: 5px">{{ __('انقر هنا لطلب آخر') }}</button>.
                </form>
            </div>
        </div>
    </section>
@endsection
