@extends('layouts.app')

@section('style')
    {{-- This is for master page  --}}
    <!--  Custom Scroll bar-->
    <link href="{{ URL::asset('frontend/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
    <!--  Sidebar css -->
    <link href="{{ URL::asset('frontend/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ URL::asset('frontend/assets/css-rtl/sidemenu.css') }}">
    @yield('css')
    <!--- Style css -->
    <link href="{{ URL::asset('frontend/assets/css-rtl/style.css') }}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{ URL::asset('frontend/assets/css-rtl/style-dark.css') }}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{ URL::asset('frontend/assets/css-rtl/skin-modes.css') }}" rel="stylesheet">

    {{-- This is for this page  --}}
    <link href="{{ URL::asset('frontend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    {{-- flat picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        إستمارة طلب تقديم كمدرب
                    </div>
                    <p class="mg-b-20">ملاحظة : سيتم اعتماد البيانات عند الانتهاء من تعبئة البيانات وارسالها , لذلك نرجو
                        القيام بإدخال كافة البيانات المطلوبة بشكل صحيح ودقيق.</p>

                    <form action="{{ route('customer.request_to_teach') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="wizard1">
                            <h3>البيانات الشخصية</h3>
                            <section>

                                <div class="control-group form-group">
                                    <label class="form-label">الإسم باللغة العربية</label>
                                    <input type="text" class="form-control required" placeholder="الاسم بالعربي">
                                </div>

                                <div class="control-group form-group">
                                    <label class="form-label">الإسم باللغة الانجليزية</label>
                                    <input type="text" class="form-control required" placeholder="الاسم بالانجليزي">
                                </div>

                                <div class="control-group form-group">
                                    <label class="form-label">تاريخ الميلاد</label>
                                    <div class="form-group">
                                        <input type="text" name="date_of_birth"
                                            class="form-control required flatpickr_date_of_birth"
                                            placeholder="تاريخ الميلاد">
                                        @error('published_on')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="control-group form-group">
                                    <label for="country_name">
                                        {{-- <i class="fa fa-globe custom-color"></i> --}}
                                        محل الميلاد
                                        <span class="required">*</span>
                                    </label>
                                    <select id="country_name" name="place_of_birth" class="form-control">
                                        @foreach (getCountries() as $country)
                                            <option value="{{ $country->name }}"
                                                data-phone-code="{{ $country->phone_code }}"
                                                data-emoji="{{ $country->emoji }}">
                                                {{ $country->name }} {{ $country->emoji }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="control-group form-group">
                                    <label for="country_name">
                                        {{-- <i class="fa fa-globe custom-color"></i> --}}
                                        الجنسية
                                        <span class="required">*</span>
                                    </label>
                                    <select id="country_name" name="nationality" class="form-control">
                                        @foreach (getCountries() as $country)
                                            <option value="{{ $country->nationality }}"
                                                data-phone-code="{{ $country->phone_code }}"
                                                data-emoji="{{ $country->emoji }}">
                                                {{ $country->nationality }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="control-group form-group">
                                    <label for="residence_address">
                                        {{-- <i class="fa fa-globe custom-color"></i> --}}
                                        عنوان/ مكان الإقامة
                                        <span class="required">*</span>
                                    </label>
                                    <select id="residence_address" name="residence_address" class="form-control">
                                        @foreach (getCountries() as $country)
                                            <option value="{{ $country->name }}"
                                                data-phone-code="{{ $country->phone_code }}"
                                                data-emoji="{{ $country->emoji }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="control-group form-group ">
                                    <label class="form-label"> المؤهل الدراسي</label>

                                    <select name="educational_qualification" class="form-control">
                                        <option value="1"
                                            {{ old('educational_qualification') == '1' ? 'selected' : null }}>
                                            {{ __('transf.Diploma') }}
                                        </option>
                                        <option value="2"
                                            {{ old('educational_qualification') == '2' ? 'selected' : null }}>
                                            {{ __('transf.Higher Diploma') }}
                                        </option>
                                        <option value="3"
                                            {{ old('educational_qualification') == '3' ? 'selected' : null }}>
                                            {{ __('transf.Bachelor') }}
                                        </option>
                                        <option value="4"
                                            {{ old('educational_qualification') == '3' ? 'selected' : null }}>
                                            {{ __('transf.Master') }}
                                        </option>
                                        <option value="5"
                                            {{ old('educational_qualification') == '3' ? 'selected' : null }}>
                                            {{ __('transf.Ph_D') }}
                                        </option>
                                        <option value="6"
                                            {{ old('educational_qualification') == '3' ? 'selected' : null }}>
                                            {{ __('transf.Professor') }}
                                        </option>
                                    </select>
                                    @error('educational_qualification')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="control-group form-group ">
                                    <label class="form-label">التخصص</label>
                                    <select name="specialization" class="form-control">
                                        @foreach ($specializations as $specialization)
                                            <option value="{{ $specialization->id }}">
                                                {{ $specialization->name }}
                                            </option>
                                        @endforeach


                                    </select>
                                    @error('specialization')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="control-group form-group mb-0">
                                    <label class="form-label">سنوات خبرة التدريب</label>
                                    <input type="number" class="form-control required" placeholder="سنوات خبرة التدريب">

                                </div>


                            </section>
                            <h3>المرفقات</h3>
                            <section>
                                <div class="control-group form-group">
                                    <label class="form-label">ارفاق صورة من الهوية / جواز السفر (واضح)</label>
                                    <input type="text" class="form-control required" placeholder="الهوية او جواز السفر">
                                </div>
                                <div class="control-group form-group">
                                    <label class="form-label">السيرة الذاتية</label>
                                    <input type="text" class="form-control required" placeholder="السيرة الذاتية">
                                </div>
                                <div class="control-group form-group mb-0">
                                    <label class="form-label"> ارفاق الشهادات </label>
                                    <input type="text" class="form-control required" placeholder="الشهادات">
                                </div>
                            </section>
                            <h3>الحافز</h3>
                            <section>
                                <div class="form-group">
                                    <label class="form-label">لماذا تريد الالتحاق بالتدريب لدينا</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                                </div>

                            </section>

                            <h3>بيانات الاستمارة </h3>
                            <section>
                                يتم تصميم الخصلاصة هنا
                                <div class="form-group pt-3">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        {{ __('panel.save_data') }}</button>
                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /row -->
@endsection

@section('script')
    <!--Internal  Select2 js -->
    <script src="{{ URL::asset('frontend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.steps js -->
    <script src="{{ URL::asset('frontend/assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <!--Internal  Form-wizard js -->
    <script src="{{ URL::asset('frontend/assets/js/form-wizard.js') }}"></script>

    <!-- Include the Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/{{ app()->getLocale() }}.js"></script>


    <script>
        $(function() {

            // for offer ends
            flatpickr('.flatpickr', {

            });

            // for offer ends
            flatpickr('.flatpickr_date_of_birth', {
                enableTime: true,
                dateFormat: "Y-m-d ",
                minDate: "today"

            });


        });
    </script>
@endsection
