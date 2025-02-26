@extends('layouts.admin')

@section('style')
    <style>
        .outer {
            font-family: Times New Roman, sans-serif;
            color: black;
        }

        .header-line {
            display: block;
        }

        .ww {
            font-weight: bold;
            font-size: 21px;
        }

        .gold-line,
        .gray-line {
            height: 4px;
        }

        .gold-line {
            background-color: gold;
            width: 99%;
            margin: auto;
            margin-bottom: 3px;
        }

        .gray-line {
            margin-bottom: 20px;
            background-color: whitesmoke;
        }

        #image-container {
            /* border: 1px solid gray; */
            margin-right: 100px;
            width: 50%;
            height: 181px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
    </style>

    <!-- Custom CSS -->
    <style>
        .modal-custom {
            max-width: 100%;
        }

        @media (min-width: 992px) {
            .modal-custom {
                max-width: 50%;
            }
        }

        .modal-image {
            width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection

@section('content')
    {{-- first section --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex flex-column flex-sm-row justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{-- {{ __('transf.Course Landing Page') }} --}}
                    {{ __('panel.show_company_requests') }}
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a>
                        @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')
                            <i class="fa fa-solid fa-chevron-left chevron"></i>
                        @else
                            <i class="fa fa-solid fa-chevron-right chevron"></i>
                        @endif
                    </li>
                    <li>
                        <a href="{{ route('admin.company_requests.index') }}">
                            {{ __('panel.show_company_requests') }}
                        </a>
                    </li>
                </ul>
            </div>


            <div class="ml-auto mt-3 mt-sm-0">
                <form action="{{ route('admin.company_requests.update_company_requests_status', $company_request->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row align-items-center">
                        <label class="sr-only" for="inlineFormInputGroupOrderStatus">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">{{ __('panel.company_status') }}</div>
                            </div>
                            <select name="status" style="outline-style:none;" onchange="this.form.submit()"
                                class="form-control">


                                <option value=""> {{ __('panel.course_choose_appropriate_event') }} </option>
                                @foreach ($company_request_status_array as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                </form>
            </div>
        </div>


        <div class="outer bg-white p-4">
            <div class="inner" style="border: 1px solid #777777">
                <header>
                    <div class="row">
                        <div class="col-sm-10 offset-1 bg-white">
                            <div class="row">
                                <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="text-success m-0" style="
        font-family: Times New Roman, sans-serif;">
                                        معهد خطوة شباب</h1>
                                    <h3 class="text-warning" style="
        font-family: Times New Roman, sans-serif;">
                                        للتدريب واللغات</h3>
                                </div>
                                <div class="col-sm-4 d-flex align-items-center justify-content-center">
                                    <img style="width: 250px; padding-top: 10px; z-index: 4"
                                        src="{{ asset('backend/images/logo.jpg') }}" alt="" />
                                </div>
                                <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="text-success m-0" style="
        font-family: Times New Roman, sans-serif;">
                                        Youth Step Institute</h1>
                                    <h3 class="text-warning" style=" font-family: Times New Roman, sans-serif;">For Training
                                        &
                                        Languages
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-line"
                        style="
                      position: relative;
                      margin-top: -40px;
                      margin-bottom: 45px;
                      z-index: 2;
                    ">
                        <div class="gold-line"></div>
                        <div class="gray-line"></div>
                    </div>
                </header>

                <div class="section px-5 pb-3">
                    <div class="row" style="border: 6px double green; font-size: 19px">
                        <div class="col-sm-12 bg-white p-3">
                            <div class="row pt-4">
                                <div class="col-4 p-4">
                                    <span><span class="ww">تاريخ الطلب :</span>
                                        {{ $company_request->created_at->format('Y/m/d') }}
                                    </span>
                                </div>
                                <div class="col-4 p-2 text-center" style="border: 4px solid green;">
                                    <h1 class="m-0 fs-2 p-2"
                                        style="border: 1px solid green;border-radius: 4px;color:black;">
                                        استمارة طلب تدريب لشركة
                                    </h1>
                                </div>
                                <div class="col-4 p-4">
                                    <p class="text-center p-0 m-0">
                                        <span class="me-2 ww">حالة الطلب : </span>
                                        {{ $company_request->status() }}
                                    </p>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-5">
                                        <span class="arabic-name ww">
                                            إسم مقدم الطلب :
                                        </span>
                                        <span class="arabic-name-value">{{ $company_request->cp_user_name }}</span>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-12 pt-3 col-md-6">
                                        <span class="date-of-birth ww"> البريد الإلكتروني : </span>
                                        <span class="date-of-birth-value">
                                            {{ $company_request->cp_user_email }}
                                        </span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-6">
                                        <span class="place-of-birth ww"> رقم الجوال : </span>
                                        <span class="place-of-birth-value">{{ $company_request->cp_user_phone }}</span>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pt-3">
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12  col-md-12 pt-3">
                                        <span class="residence-address ww">
                                            إسم الشركة :
                                        </span>
                                        <span class="residence-address-value">
                                            {{ $company_request->cp_company_name }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 pt-3">
                                        <span class="residence-address ww">
                                            المسمي الوظيفي :
                                        </span>
                                        <span class="residence-address-value">
                                            {{ $company_request->cp_job_title }}
                                        </span>
                                    </div>
                                    <div class="col-sm-12  col-md-6 pt-3">
                                        <span class="educational_qualification ww">
                                            حجم الشركة :
                                        </span>
                                        <span
                                            class="educational-qualification-value">{{ $company_request->cp_company_size }}
                                            شخص</span>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm-12 pt-3 col-md-6">
                                        <span class="specialization ww ">الدولة : </span>
                                        <span class="specialization-value"> {{ $company_request->country->name }} (
                                            {{ $company_request->country->name_native }} )
                                        </span>
                                    </div>
                                    <div class="col-sm-12 pt-3 col-md-6">
                                        <span class="years_of_training_experience ww">
                                            المدينة :
                                        </span>
                                        <span class="years_of_training_experience-value">
                                            {{ $company_request->cp_company_city }} </span>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>

                    <footer class="d-flex justify-content-center" style="text-align: center;margin-top: 50px;">
                        <div class="footer-line"
                            style="
            height: 3px;
          background-color: green;
          margin-bottom: 20px;
          margin-left: 20px;
          margin-right: 20px;
          margin-top: auto;
       width: 75.5%;
          position: absolute
        
                    ">
                        </div>
                        <div class="footer-content" style="margin-top: 10px;">
                            {{-- <div class="footer-item">
                                <i class="fa fa-home"></i>
                                <span>محافظة عدن-المنصورة-شارع القصر-فوق انيس فون</span>
                            </div> --}}
                            {{-- <div class="footer-item">
                                <i class="fa fa-phone"></i>
                                <span> 02-350347 \ 734208108</span>
                            </div> --}}
                            <div class="footer-item">
                                <i class="fa fa-phone"></i>
                                <span>
                                    {{ $siteSettings['site_phone']->value ?? '' }} \
                                    {{ $siteSettings['site_mobile']->value ?? '' }}
                                </span>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>


        <!-- Modal Identity image -->
        <div class="modal fade" id="identityModal" tabindex="-1" role="dialog" aria-labelledby="identityModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-custom" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="identityModalLabel">Identity Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('assets/company_requests/' . $company_request->identity) }}"
                            alt="Identity Image" class="img-fluid modal-image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
