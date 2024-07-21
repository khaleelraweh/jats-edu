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
    <div class="container mt-2">
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

                        <form id="requestForm" action="{{ route('customer.request_to_teach') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div id="wizard1">
                                <h3>البيانات الشخصية</h3>
                                <section>

                                    <div class="row pt-2">
                                        <div class="col-sm-12 col-md-6 ">
                                            <div class="control-group form-group">
                                                <label class="form-label">
                                                    الإسم باللغة العربية
                                                    <span class="required text-danger">*</span>
                                                </label>
                                                <input type="text" name="full_name[ar]" class="form-control required"
                                                    value="{{ old('full_name.ar') }}">
                                                @error('full_name.ar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="control-group form-group ">
                                                <label class="form-label">
                                                    الإسم باللغة الانجليزية
                                                    <span class="required text-danger">*</span>
                                                </label>
                                                <input type="text" name="full_name[en]" class="form-control required"
                                                    value="{{ old('full_name.en') }}">
                                                @error('full_name.en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="control-group form-group">
                                                <label class="form-label">
                                                    تاريخ الميلاد
                                                    <span class="required text-danger">*</span>

                                                </label>
                                                <div class="form-group">
                                                    <input type="text" name="date_of_birth"
                                                        class="form-control required flatpickr_date_of_birth"
                                                        value="{{ old('date_of_birth') }}">
                                                    @error('date_of_birth')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class="control-group form-group">
                                                <label for="place_of_birth">
                                                    {{-- <i class="fa fa-globe custom-color"></i> --}}
                                                    مكان الميلاد
                                                    <span class="required text-danger">*</span>
                                                </label>
                                                <select id="place_of_birth" name="place_of_birth" class="form-control">
                                                    <option value="">---</option>
                                                    @foreach (getCountries() as $country)
                                                        <option value="{{ $country->name }}"
                                                            {{ old('place_of_birth') == $country->name ? 'selected' : '' }}>
                                                            {{ $country->name }} {{ $country->emoji }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('place_of_birth')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class="control-group form-group">
                                                <label for="nationality">
                                                    الجنسية
                                                    <span class="required text-danger">*</span>
                                                </label>
                                                <select id="nationality" name="nationality" class="form-control">
                                                    <option value="">---</option>
                                                    @foreach (getCountries() as $country)
                                                        <option value="{{ $country->nationality }}"
                                                            {{ old('nationality') == $country->nationality ? 'selected' : '' }}>
                                                            {{ $country->nationality }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('nationality')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="control-group form-group">
                                                <label for="residence_address">
                                                    {{-- <i class="fa fa-globe custom-color"></i> --}}
                                                    عنوان/ مكان الإقامة
                                                    <span class="required text-danger">*</span>
                                                </label>
                                                <select id="residence_address" name="residence_address"
                                                    class="form-control">
                                                    <option value="">---</option>
                                                    @foreach (getCountries() as $country)
                                                        <option value="{{ $country->name }}"
                                                            {{ old('residence_address') == $country->name ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('residence_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="control-group form-group">
                                                <label for="phone">
                                                    {{-- <i class="fa fa-globe custom-color"></i> --}}
                                                    رقم الجوال
                                                    <span class="required text-danger">*</span>
                                                </label>
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ old('phone') }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="control-group form-group ">
                                                <label class="form-label"> المؤهل الدراسي</label>

                                                <select name="educational_qualification" class="form-control">
                                                    <option value="">---</option>
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
                                                        {{ old('educational_qualification') == '4' ? 'selected' : null }}>
                                                        {{ __('transf.Master') }}
                                                    </option>
                                                    <option value="5"
                                                        {{ old('educational_qualification') == '5' ? 'selected' : null }}>
                                                        {{ __('transf.Ph_D') }}
                                                    </option>
                                                    <option value="6"
                                                        {{ old('educational_qualification') == '6' ? 'selected' : null }}>
                                                        {{ __('transf.Professor') }}
                                                    </option>
                                                </select>
                                                @error('educational_qualification')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class="control-group form-group ">
                                                <label class="form-label">التخصص</label>
                                                <select name="specialization" class="form-control">
                                                    <option value="">---</option>
                                                    @foreach ($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}"
                                                            {{ old('specialization') == $specialization->id ? 'selected' : '' }}>
                                                            {{ $specialization->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('specialization')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class="control-group form-group mb-0">
                                                <label class="form-label">سنوات خبرة التدريب</label>
                                                <input type="number" name="years_of_training_experience"
                                                    class="form-control required"
                                                    value="{{ old('years_of_training_experience') }}">
                                                @error('years_of_training_experience')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                </section>
                                <h3>المرفقات</h3>
                                <section>
                                    <div class="control-group form-group">
                                        <label class="form-label">ارفاق صورة من الهوية / جواز السفر (واضح)</label>
                                        <input type="file" name="identity" class="form-control required">
                                        @error('identity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="form-label">السيرة الذاتية</label>
                                        <input type="file" name="biography" class="form-control required"
                                            accept="application/pdf">
                                        @error('biography')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="control-group form-group mb-0">
                                        <label class="form-label"> ارفاق الشهائد (<small>يجب تضمين جميع الشهائد المراد
                                                رفعها
                                                في ملف pdf</small>) </label>
                                        <input type="file" name="Certificates" class="form-control required">
                                        @error('Certificates')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </section>
                                <h3>الحافز</h3>
                                <section>
                                    <div class="form-group">
                                        <label class="form-label">لماذا تريد الالتحاق بالتدريب لدينا</label>
                                        <textarea class="form-control" name="motivation" id="" cols="30" rows="10">{{ old('motivation') }}</textarea>
                                        @error('motivation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </section>

                                <h3>بيانات الاستمارة </h3>
                                <section>
                                    <button type="submit" style="display: none;" id="hiddenSubmitButton"></button>
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
    </div>
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

            // Replace the "Finish" link with a button after the wizard is initialized
            $('a[href="#finish"]').each(function() {


                $(this).on('click', function() {
                    $('#hiddenSubmitButton').click();

                });

            });



        });
    </script>
@endsection
